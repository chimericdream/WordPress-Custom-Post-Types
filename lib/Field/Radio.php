<?php
class WPCPT_Field_Radio extends WPCPT_Field {
    public function renderField() {
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
                echo " type=\"radio\" name=\"{$this->fieldName}\" value=\"{$v}\"";
                if ($this->value == $v) {
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
                echo " type=\"radio\" name=\"{$this->fieldName}\" value=\"{$k}\"";
                if ($this->value == $k) {
                    echo ' checked="checked"';
                }
                echo "> {$v}</label>";
                $first = false;
            }
        }
    }
}