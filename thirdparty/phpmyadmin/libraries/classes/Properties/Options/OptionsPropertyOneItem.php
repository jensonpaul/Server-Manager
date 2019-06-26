<?php

/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Superclass for the single Property Item classes.
 */

namespace PhpMyAdmin\Properties\Options;

/**
 * Parents only single property items (not groups).
 * Defines possible options and getters and setters for them.
 */
abstract class OptionsPropertyOneItem extends OptionsPropertyItem
{
    /**
     * Whether to force or not.
     *
     * @var bool
     */
    private $_force_one;
    /**
     * Values.
     *
     * @var array
     */
    private $_values;
    /**
     * Doc.
     *
     * @var string
     */
    private $_doc;
    /**
     * Length.
     *
     * @var int
     */
    private $_len;
    /**
     * Size.
     *
     * @var int
     */
    private $_size;
    /* ~~~~~~~~~~~~~~~~~~~~ Getters and Setters ~~~~~~~~~~~~~~~~~~~~ */

    /**
     * Gets the force parameter.
     *
     * @return string
     */
    public function getForce()
    {
        return $this->_force_one;
    }

    /**
     * Sets the force parameter.
     *
     * @param bool $force force parameter
     */
    public function setForce($force)
    {
        $this->_force_one = $force;
    }

    /**
     * Gets the values.
     *
     * @return string
     */
    public function getValues()
    {
        return $this->_values;
    }

    /**
     * Sets the values.
     *
     * @param array $values values
     */
    public function setValues(array $values)
    {
        $this->_values = $values;
    }

    /**
     * Gets MySQL documentation pointer.
     *
     * @return array
     */
    public function getDoc()
    {
        return $this->_doc;
    }

    /**
     * Sets the doc.
     *
     * @param string $doc MySQL documentation pointer
     */
    public function setDoc($doc)
    {
        $this->_doc = $doc;
    }

    /**
     * Gets the length.
     *
     * @return int
     */
    public function getLen()
    {
        return $this->_len;
    }

    /**
     * Sets the length.
     *
     * @param int $len length
     */
    public function setLen($len)
    {
        $this->_len = $len;
    }

    /**
     * Gets the size.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * Sets the size.
     *
     * @param int $size size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }
}