<?php
namespace WPCPT\Field\Textarea;

use \WPCPT\Field\Textarea;

class NoWysiwyg extends Textarea
{
    public function renderField()
    {
        echo '<div class="plain-textarea-wrap">';
        if (!empty($this->note)) {
            echo "<p><strong>Note:</strong> {$this->note}</p>";
        }
        echo '<textarea id="' . $this->fieldId . '" name="' . $this->getNameAttribute() . '"';
        $this->renderAttributes();
        echo ">{$this->value}</textarea></div>";
    }
}
