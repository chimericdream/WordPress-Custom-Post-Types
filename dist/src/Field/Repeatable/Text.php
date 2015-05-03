<?php
namespace WPCPT\Field\Repeatable;

use \WPCPT\Field\Repeatable;
use \WPCPT\Field\Text as TextField;

class Text extends Repeatable
{
    protected function generateFields($val = '', $idx = null)
    {
        $field = new TextField($val);
        $atts = array(
            'data-id'    => $this->fieldId . '_{x}',
            'data-name'  => $this->fieldId . '[{x}]',
            'data-field' => $this->fieldId,
        );
        if ($idx !== null) {
            $atts['data-idx'] = $idx;
        }
        $field->setId('')
              ->setAttributes($atts)
              ->renderField();
        echo " <a class=\"icon-add\" data-add=\"{$this->fieldId}\" href=\"#\">Add</a>";
        if ($idx !== 0) {
            echo " <a class=\"icon-remove\" data-remove=\"{$this->fieldId}\" href=\"#\">Remove</a>";
        }
    }
}