<?php
namespace WPCPT\Field;

use \WPCPT\Field;
use \WPCPT\Fieldset;

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

    abstract public function setFields(Fieldset &$fs);
}
