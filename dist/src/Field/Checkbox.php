<?php
namespace WPCPT\Field;

use \WPCPT\Field;

class Checkbox extends Field
{
    public function renderField()
    {
        $id    = true;
        $first = true;
        if (empty($this->fieldName)) {
            $this->fieldName = $this->fieldId;
        }
        if (array_values($this->options) === $this->options) {
            foreach ($this->options as $v) {
                if (!$first) {
                    echo '<br>';
                }
                echo '<label><input';
                if ($id) {
                    echo ' id="' . $this->fieldId . '"';
                    $id = false;
                }
                echo " type=\"checkbox\" name=\"{$this->fieldName}[]\" value=\"{$v}\"";
                if (is_array($this->value) && in_array($v, $this->value)) {
                    echo ' checked="checked"';
                }
                echo "> {$v}</label>";
                $first = false;
            }
        } else {
            foreach ($this->options as $k => $v) {
                if (!$first) {
                    echo '<br>';
                }
                echo '<label><input';
                if ($id) {
                    echo ' id="' . $this->fieldId . '"';
                    $id = false;
                }
                echo " type=\"checkbox\" name=\"{$this->fieldName}[]\" value=\"{$k}\"";
                if (is_array($this->value) && in_array($k, $this->value)) {
                    echo ' checked="checked"';
                }
                echo "> {$v}</label>";
                $first = false;
            }
        }
    }
}
