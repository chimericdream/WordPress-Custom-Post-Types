<?php
class WPCPT_Field_Repeatable_Select extends WPCPT_Field_Repeatable {
    protected function generateFields($val = '', $idx = NULL) {
        $field = new WPCPT_Field_Select($val);
        $atts = array(
            'data-id'    => $this->fieldId . '_{x}',
            'data-name'  => $this->fieldId . '[{x}]',
            'data-field' => $this->fieldId,
        );
        if ($idx !== NULL) {
            $atts['data-idx'] = $idx;
        }
        $field->setId('')
              ->setName('')
              ->setOptions($this->options)
              ->setAttributes($atts)
              ->renderField();
        echo " <a class=\"icon-add\" data-add=\"{$this->fieldId}\" href=\"#\">Add</a>";
        if ($idx !== 0) {
            echo " <a class=\"icon-remove\" data-remove=\"{$this->fieldId}\" href=\"#\">Remove</a>";
        }
    }
}