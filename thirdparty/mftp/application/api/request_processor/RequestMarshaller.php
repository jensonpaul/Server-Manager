<?php

    require_once dirname(__FILE__).'/RequestDispatcher.php';
    require_once dirname(__FILE__).'/../lib/helpers.php';
    require_once dirname(__FILE__).'/../system/ApplicationSettings.php';

    class RequestMarshaller
    {
        /**
         * @var RequestDispatcher
         */
        private $requestDispatcher;

        public function __construct($requestDispatcher = null)
        {
            /* supplied only for testing. normally we wouldn't know how to instantiate the RequestDispatcher until we
            have the request*/
            $this->requestDispatcher = $requestDispatcher;
        }

        private static function buildTransferContext($request)
        {
            $remotePath = $request['context']['remotePath'];
            $remoteFileName = monstaBasename($remotePath);
            $localPath = tempnam(getMonstaSharedTransferDirectory(), $remoteFileName);
            $downloadContext = array(
                'localPath' => $localPath,
                'remotePath' => $remotePath,
            );
            return array($localPath, $downloadContext);
        }

        private static function validateActionName($request, $expectedActionName)
        {
            if ($request['actionName'] != $expectedActionName) {
                throw new InvalidArgumentException("Got invalid action, expected \"$expectedActionName\", got \"".
                    $request['actionName'].'"');
            }
        }

        private function applyConnectionRestrictions($connectionType, $configuration)
        {
            $license = readDefaultMonstaLicense();
            if (is_null($license) || !$license->isLicensed()) {
                return $configuration;
            }

            $applicationSettings = new ApplicationSettings(APPLICATION_SETTINGS_PATH);

            $connectionRestrictions = $applicationSettings->getUnblankedConnectionRestrictions();

            if (is_array($connectionRestrictions)) {
                if (key_exists($connectionType, $connectionRestrictions)) {
                    foreach ($connectionRestrictions[$connectionType] as $restrictionKey => $restrictionValue) {
                        if ('host' === $restrictionKey && is_array($restrictionValue)) {
                            if (false !== array_search($configuration[$restrictionKey], $restrictionValue)) {
                                continue;
                            } else {
                                throw new MFTPException('Attempting to connect with a host not specified in connection restrictions.');
                            }
                        }

                        $configuration[$restrictionKey] = $restrictionValue;
                    }
                }
            }

            return $configuration;
        }

        private function initRequestDispatcher($request, $skipConfiguration = false)
        {
            if (!$skipConfiguration) {
                $request['configuration'] = $this->applyConnectionRestrictions(
                    $request['connectionType'],
                    $request['configuration']
                );
            }

            if (is_null($this->requestDispatcher)) {
                $this->requestDispatcher = new RequestDispatcher(
                    $request['connectionType'],
                    $request['configuration'],
                    null,
                    null,
                    $skipConfiguration
                );
            }
        }

        public function testConfiguration($request)
        {
            $this->initRequestDispatcher($request);
            return $this->requestDispatcher->testConnectAndAuthenticate($request['context']);
        }

        public function disconnect()
        {
            if (null != $this->requestDispatcher) {
                $this->requestDispatcher->disconnect();
            }
        }

        public function marshallRequest($request, $skipConfiguration = false, $skipEncode = false)
        {
            $this->initRequestDispatcher($request, $skipConfiguration);

            $response = array();

            if ('putFileContents' == $request['actionName']) {
                $response = $this->putFileContents($request);
            } elseif ('getFileContents' == $request['actionName']) {
                $response = $this->getFileContents($request);
            } else {
                $context = array_key_exists('context', $request) ? $request['context'] : null;

                $responseData = $this->requestDispatcher->dispatchRequest($request['actionName'], $context);
                $response['success'] = true;

                if (is_object($responseData)) {
                    $response['data'] = method_exists($responseData, 'legacyJsonSerialize') ?
                        $responseData->legacyJsonSerialize() : $responseData;
                } else {
                    $response['data'] = $responseData;
                }
            }

            if ($skipEncode) {
                return $response;
            }

            return json_encode($response);
        }

        public function prepareFileForFetch($request)
        {
            // this will fetch the file from the remote server to a tmp location, then return that path
            self::validateActionName($request, 'fetchFile');

            $this->initRequestDispatcher($request);

            list($localPath, $transferContext) = self::buildTransferContext($request);

            try {
                $this->requestDispatcher->downloadFile($transferContext);
            } catch (Exception $e) {
                unlink($localPath);
                throw $e;
            }

            return $localPath;
        }

        public function putFileContents($request)
        {
            self::validateActionName($request, 'putFileContents');

            $this->initRequestDispatcher($request);

            if (!isset($request['context']['fileContents'])) {
                throw new InvalidArgumentException("Can't put file contents if fileContents is not supplied.");
            }

            $fileContents = $request['context']['fileContents'];
            $originalFileContents = array_key_exists('originalFileContents', $request['context']) ?
                $request['context']['originalFileContents'] : null;

            if (array_key_exists('encoding', $request['context'])) {
                $fileContentsEncoding = $request['context']['encoding'];

                switch ($fileContentsEncoding) {
                    case 'rot13':
                        $fileContents = str_rot13($fileContents);
                        if (!is_null($originalFileContents)) {
                            $originalFileContents = str_rot13($originalFileContents);
                        }
                        break;
                    default:
                        break;
                }
            }

            $decodedContents = b64DecodeUnicode($fileContents);

            if (!$request['context']['confirmOverwrite'] && !is_null($originalFileContents)) {
                $originalFileContents = b64DecodeUnicode($originalFileContents);
                list($serverFileLocalPath, $transferContext) = self::buildTransferContext($request);

                try {
                    $this->requestDispatcher->downloadFile($transferContext);
                    $serverFileContents = fileGetContentsInUtf8($serverFileLocalPath);
                } catch (Exception $e) {
                    @unlink($serverFileLocalPath);
                    throw $e;
                }

                @unlink($serverFileLocalPath);

                if ($serverFileContents === $decodedContents) {
                    // edited in server matches edited in browser no need to update
                    return array(
                        'success' => true,
                    );
                }

                if ($serverFileContents != $originalFileContents) {
                    throw new LocalizableException(
                        'File has changed on server since last load.',
                        LocalizableExceptionDefinition::$FILE_CHANGED_ON_SERVER
                    );
                }
            }

            list($localPath, $transferContext) = self::buildTransferContext($request);

            try {
                file_put_contents($localPath, $decodedContents);
                $this->requestDispatcher->uploadFile($transferContext);
            } catch (Exception $e) {
                @unlink($localPath);
                throw $e;
            }

            // this should be done in a finally to avoid repeated code but we need to support PHP < 5.5
            @unlink($localPath);

            return array(
                'success' => true,
            );
        }

        public function getFileContents($request)
        {
            self::validateActionName($request, 'getFileContents');

            $this->initRequestDispatcher($request);

            list($localPath, $transferContext) = self::buildTransferContext($request);

            try {
                $this->requestDispatcher->downloadFile($transferContext);
                $fileContents = fileGetContentsInUtf8($localPath);
            } catch (Exception $e) {
                @unlink($localPath);
                throw $e;
            }

            // this should be done in a finally to avoid repeated code but we need to support PHP < 5.5
            @unlink($localPath);

            $encodedContents = b64EncodeUnicode($fileContents);

            return array(
                'success' => true,
                'data' => $encodedContents,
            );
        }
    }