<?php
namespace WPCPT\Field;

use \WPCPT\Field;

class Text extends Field
{
    public function renderField()
    {
        echo '<input type="text" id="' . $this->fieldId . '" name="' . $this->getNameAttribute() . '"';
        $this->renderAttributes();
        echo ' value="' . $this->value . '">';
        if (!empty($this->note)) {
            echo '<p class="description">' . $this->note . '</p>';
        }
    }
}
