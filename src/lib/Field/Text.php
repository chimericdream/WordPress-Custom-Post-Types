<?php
class WPCPT_Field_Text extends WPCPT_Field
{
    public function renderField()
    {
        echo "<input type=\"text\" id=\"{$this->fieldId}\" name=\"";
        echo (!empty($this->fieldName)) ? $this->fieldName : $this->fieldId;
        echo '"';
        $this->renderAttributes();
        echo " value=\"{$this->value}\">";
        if (!empty($this->note)) {
            echo '<p class="description">' . $this->note . '</p>';
        }
    }
}
