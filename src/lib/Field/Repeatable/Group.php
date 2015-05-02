<?php
namespace WPCPT\Field\Repeatable;

use WPCPT\Field\Repeatable;
use WPCPT\Field\Select;
use WPCPT\Field\Text;
use WPCPT\Field\Textarea\NoWysiwyg;

class Group extends Repeatable
{
    protected $fields = array();

    public function setFields($fields = array())
    {
        $this->fields = $fields;
    }

    protected function generateFields($val = '', $idx = 'template')
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
                $f['atts']['data-id']    = $this->fieldId . '_{x}_' . $f['name'];
                $f['atts']['data-name']  = $this->fieldId . '[{x}][' . $f['name'] . ']';
                $f['atts']['data-field'] = $this->fieldId;
                if ($idx !== 'template') {
                    $f['atts']['data-idx'] = $idx;
                }
                switch($f['type']) {
                    case 'select':
                        $field = new Select($v);
                        $field->setOptions($f['options'])->setAttributes($f['atts'])->renderField();
                        break;
                    case 'text':
                        $field = new Text($v);
                        $field->setAttributes($f['atts'])->renderField();
                        break;
                    case 'textarea':
                        $field = new NoWysiwyg($v);
                        $field->setAttributes($f['atts'])->renderField();
                        break;
                }
            } else {
                echo $f;
            }
        }
        echo " <a class=\"icon-add\" data-add=\"{$this->fieldId}\" href=\"#\">Add</a>";
        if ($idx !== 0) {
            echo " <a class=\"icon-remove\" data-remove=\"{$this->fieldId}\" href=\"#\">Remove</a>";
        }
    }
}
