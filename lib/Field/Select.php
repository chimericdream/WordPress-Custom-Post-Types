<?php
class WPCPT_Field_Select extends WPCPT_Field {
    public function renderField() {
        echo "<select id=\"{$this->fieldId}\" name=\"";
        echo (!empty($this->fieldName)) ? $this->fieldName : $this->fieldId;
        echo '"';
        $this->renderAttributes();
        echo ">";
        if (array_values($this->options) === $this->options) {
            foreach ($this->options as $v) {
                echo "<option value=\"{$v}\"";
                if ($this->value == $v) {
                    echo ' selected="selected"';
                }
                echo ">{$v}</option>";
            }
        } else {
            foreach ($this->options as $k => $v) {
                echo "<option value=\"{$k}\"";
                if ($this->value == $k) {
                    echo ' selected="selected"';
                }
                echo ">{$v}</option>";
            }
        }
        echo '</select>';
        if (!empty($this->note)) {
            echo '<p class="description">' . $this->note . '</p>';
        }
    }
}