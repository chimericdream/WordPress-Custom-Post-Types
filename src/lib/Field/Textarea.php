<?php
class WPCPT_Field_Textarea extends WPCPT_Field
{
    public function renderField()
    {
        $this->options = array_merge(
            array(
                'media_buttons' => false,
                'textarea_rows' => 5,
            ),
            $this->options
        );
        wp_editor($this->value, $this->fieldId, $this->options);
    }
}
