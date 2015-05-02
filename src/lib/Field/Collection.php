<?php
namespace WPCPT\Field;

use WPCPT\Field;

abstract class Collection extends Field
{
    protected $options = array();

    public function __construct($options = array())
    {
        $this->options = $options;
        return $this;
    }

    public function render()
    {
        return '';
    }

    abstract public function setFields(WPCPT_Fieldset &$fs);
}
