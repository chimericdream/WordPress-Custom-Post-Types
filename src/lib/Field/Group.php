<?php
class WPCPT_Field_Group extends WPCPT_Field
{
    protected $fields = array();

    public function setFields($fields = array())
    {
        $this->fields = $fields;
    }

    public function render()
    {
        echo '<tr valign="top">';
        $this->showLabel();
        if (!is_array($this->value)) {
            $this->value = json_decode($this->value, true);
        }
        if (empty($this->value)) {
            $this->value = array('');
        }
        echo '<td>';
        $this->generateFields($this->value);
        echo '</td></tr>';
    }

    protected function generateFields($val = '')
    {
        foreach ($this->fields as $f) {
            if (is_array($f)) {
                $v = '';
                if (is_array($val) && array_key_exists($f['name'], $val)) {
                    $v = $val[$f['name']];
                }
                if (!array_key_exists('atts', $f)) {
                    $f['atts'] = array();
                }
                $fieldId    = $this->fieldId . '_' . $f['name'];
                $fieldName  = $this->fieldId . '[' . $f['name'] . ']';
                switch($f['type']) {
                    case 'select':
                        $field = new WPCPT_Field_Select($v);
                        $field->setId($fieldId)->setName($fieldName)->setOptions($f['options'])->setAttributes($f['atts'])->renderField();
                        break;
                    case 'text':
                        $field = new WPCPT_Field_Text($v);
                        $field->setId($fieldId)->setName($fieldName)->setAttributes($f['atts'])->renderField();
                        break;
                    case 'textarea':
                        $field = new WPCPT_Field_Textarea_NoWysiwyg($v);
                        $field->setId($fieldId)->setName($fieldName)->setAttributes($f['atts'])->renderField();
                        break;
                }
            } else {
                echo $f;
            }
        }
    }
}
