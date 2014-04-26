<?php
abstract class WPCPT_Field_Collection extends WPCPT_Field {
    protected $options = array();

    public function __construct($options = array()) {
        $this->options = $options;
        return $this;
    }

    public function render() {
        return '';
    }

    abstract public function setFields(WPCPT_Fieldset &$fs);
}