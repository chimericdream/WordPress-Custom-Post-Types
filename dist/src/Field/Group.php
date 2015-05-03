<?php
namespace WPCPT\Field;

use \WPCPT\Field;
use \WPCPT\Field\Select;
use \WPCPT\Field\Text;
use \WPCPT\Field\Textarea\NoWysiwyg;

class Group extends Field
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
            if (!is_array($f)) {
                echo $f;
                continue;
            }
            $v = (is_array($val) && array_key_exists($f['name'], $val)) ? $val[$f['name']] : '';
            if (!array_key_exists('atts', $f)) {
                $f['atts'] = array();
            }
            switch($f['type']) {
                case 'select':
                    $this->renderSelect($v, $f);
                    break;
                case 'text':
                    $this->renderText($v, $f);
                    break;
                case 'textarea':
                    $this->renderTextarea($v, $f);
                    break;
            }
        }
    }

    private function renderSelect($value, $data)
    {
        $id    = $this->fieldId . '_' . $data['name'];
        $name  = $this->fieldId . '[' . $data['name'] . ']';
        $field = new Select($value);
        $field->setId($id)
              ->setName($name)
              ->setOptions($data['options'])
              ->setAttributes($data['atts'])
              ->renderField();
    }

    private function renderText($value, $data)
    {
        $id    = $this->fieldId . '_' . $data['name'];
        $name  = $this->fieldId . '[' . $data['name'] . ']';
        $field = new Text($value);
        $field->setId($id)
              ->setName($name)
              ->setAttributes($data['atts'])
              ->renderField();
    }

    private function renderTextarea($value, $data)
    {
        $id    = $this->fieldId . '_' . $data['name'];
        $name  = $this->fieldId . '[' . $data['name'] . ']';
        $field = new NoWysiwyg($value);
        $field->setId($id)
              ->setName($name)
              ->setAttributes($data['atts'])
              ->renderField();
    }
}
