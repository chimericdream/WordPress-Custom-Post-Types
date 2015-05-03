<?php
namespace WPCPT\Field;

use \WPCPT\Field;

class Radio extends Field
{
    public function renderField()
    {
        if (empty($this->fieldName)) {
            $this->fieldName = $this->fieldId;
        }
        $keys     = array_keys($this->options);
        $keycount = count($keys);
        for ($i = 0; $i < $keycount; $i++) {
            echo ($i === 0) ? '<br>' : '';
            echo '<label><input';
            echo ($i === 0) ? ' id="' . $this->fieldId . '"' : '';
            echo ' type="radio" name="' . $this->fieldName . '" value="' . $keys[$i] . '"';
            echo ($this->value == $keys[$i]) ? ' checked="checked"' : '';
            echo "> {$this->options[$keys[$i]]}</label>";
        }
    }
}
