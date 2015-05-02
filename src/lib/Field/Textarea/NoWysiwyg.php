<?php
class WPCPT_Field_Textarea_NoWysiwyg extends WPCPT_Field_Textarea
{
    public function renderField()
    {
        echo '<div class="plain-textarea-wrap">';
        if (!empty($this->note)) {
            echo "<p><strong>Note:</strong> {$this->note}</p>";
        }
        echo "<textarea id=\"{$this->fieldId}\" name=\"";
        if (empty($this->fieldName)) {
            echo $this->fieldId;
        } else {
            echo $this->fieldName;
        }
        echo "\"";
        $this->renderAttributes();
        echo ">{$this->value}</textarea></div>";
    }
}
