<?php
abstract class WPCPT_Field {
    protected $fieldId    = '';
    protected $fieldName  = NULL;
    protected $labelText  = '&nbsp;';
    protected $value      = '';
    protected $attributes = array();
    protected $options    = array();
    protected $note       = '';

    abstract public function render();

    public function __construct($value = '') {
        $this->value = $value;
    }

    public function setId($id) {
        $this->fieldId = $id;
        return $this;
    }

    public function setName($name) {
        $this->fieldName = $name;
        return $this;
    }

    public function setLabel($label) {
        $this->labelText = $label;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setAttributes($atts) {
        $this->attributes = $atts;
        return $this;
    }

    public function setOptions($opts) {
        $this->options = $opts;
        return $this;
    }

    public function setNote($note) {
        $this->note = $note;
        return $this;
    }

    protected function showLabel() {
        echo "<th scope=\"row\"><label for=\"{$this->fieldId}\">{$this->labelText}</label></th>";
    }

    protected function renderAttributes() {
        foreach ($this->attributes as $att => $val) {
            echo " {$att}=\"{$val}\"";
        }
    }
}