<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * CSV import plugin for phpMyAdmin using LOAD DATA.
 */

namespace PhpMyAdmin\Plugins\Import;

use PhpMyAdmin\Import;
use PhpMyAdmin\Message;
use PhpMyAdmin\Properties\Options\Items\BoolPropertyItem;
use PhpMyAdmin\Properties\Options\Items\TextPropertyItem;
use PhpMyAdmin\Util;

if (!defined('PHPMYADMIN')) {
    exit;
}

// We need relations enabled and we work only on database
if ('table' !== $GLOBALS['plugin_param']) {
    $GLOBALS['skip_import'] = true;

    return;
}

/**
 * Handles the import for the CSV format using load data.
 */
class ImportLdi extends AbstractImportCsv
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->setProperties();
    }

    /**
     * Sets the import plugin properties.
     * Called in the constructor.
     */
    protected function setProperties()
    {
        if ('auto' == $GLOBALS['cfg']['Import']['ldi_local_option']) {
            $GLOBALS['cfg']['Import']['ldi_local_option'] = false;

            $result = $GLOBALS['dbi']->tryQuery(
                'SELECT @@local_infile;'
            );
            if (false != $result && $GLOBALS['dbi']->numRows($result) > 0) {
                $tmp = $GLOBALS['dbi']->fetchRow($result);
                if ('ON' == $tmp[0]) {
                    $GLOBALS['cfg']['Import']['ldi_local_option'] = true;
                }
            }
            $GLOBALS['dbi']->freeResult($result);
            unset($result);
        }

        $generalOptions = parent::setProperties();
        $this->properties->setText('CSV using LOAD DATA');
        $this->properties->setExtension('ldi');

        $leaf = new TextPropertyItem(
            'columns',
            __('Column names: ')
        );
        $generalOptions->addProperty($leaf);

        $leaf = new BoolPropertyItem(
            'ignore',
            __('Do not abort on INSERT error')
        );
        $generalOptions->addProperty($leaf);

        $leaf = new BoolPropertyItem(
            'local_option',
            __('Use LOCAL keyword')
        );
        $generalOptions->addProperty($leaf);
    }

    /**
     * Handles the whole import logic.
     *
     * @param array &$sql_data 2-element array with sql data
     */
    public function doImport(array &$sql_data = array())
    {
        global $finished, $import_file, $charset_conversion, $table;
        global $ldi_local_option, $ldi_replace, $ldi_ignore, $ldi_terminated,
               $ldi_enclosed, $ldi_escaped, $ldi_new_line, $skip_queries, $ldi_columns;

        $compression = $GLOBALS['import_handle']->getCompression();

        if ('none' == $import_file
            || 'none' != $compression
            || $charset_conversion
        ) {
            // We handle only some kind of data!
            $GLOBALS['message'] = Message::error(
                __('This plugin does not support compressed imports!')
            );
            $GLOBALS['error'] = true;

            return;
        }

        $sql = 'LOAD DATA';
        if (isset($ldi_local_option)) {
            $sql .= ' LOCAL';
        }
        $sql .= ' INFILE \''.$GLOBALS['dbi']->escapeString($import_file)
            .'\'';
        if (isset($ldi_replace)) {
            $sql .= ' REPLACE';
        } elseif (isset($ldi_ignore)) {
            $sql .= ' IGNORE';
        }
        $sql .= ' INTO TABLE '.Util::backquote($table);

        if (strlen($ldi_terminated) > 0) {
            $sql .= ' FIELDS TERMINATED BY \''.$ldi_terminated.'\'';
        }
        if (strlen($ldi_enclosed) > 0) {
            $sql .= ' ENCLOSED BY \''
                .$GLOBALS['dbi']->escapeString($ldi_enclosed).'\'';
        }
        if (strlen($ldi_escaped) > 0) {
            $sql .= ' ESCAPED BY \''
                .$GLOBALS['dbi']->escapeString($ldi_escaped).'\'';
        }
        if (strlen($ldi_new_line) > 0) {
            if ('auto' == $ldi_new_line) {
                $ldi_new_line
                    = (PHP_EOL == "\n")
                    ? '\n'
                    : '\r\n';
            }
            $sql .= ' LINES TERMINATED BY \''.$ldi_new_line.'\'';
        }
        if ($skip_queries > 0) {
            $sql .= ' IGNORE '.$skip_queries.' LINES';
            $skip_queries = 0;
        }
        if (strlen($ldi_columns) > 0) {
            $sql .= ' (';
            $tmp = preg_split('/,( ?)/', $ldi_columns);
            $cnt_tmp = count($tmp);
            for ($i = 0; $i < $cnt_tmp; ++$i) {
                if ($i > 0) {
                    $sql .= ', ';
                }
                /* Trim also `, if user already included backquoted fields */
                $sql .= Util::backquote(
                    trim($tmp[$i], " \t\r\n\0\x0B`")
                );
            } // end for
            $sql .= ')';
        }

        Import::runQuery($sql, $sql, $sql_data);
        Import::runQuery('', '', $sql_data);
        $finished = true;
    }
}