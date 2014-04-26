<?php
abstract class WPCPT_Field_Repeatable extends WPCPT_Field {
    public function render() {
        ob_start();

        echo '<tr valign="top" data-field="' . $this->fieldId . '" data-idx="0">';
        $this->showLabel();
        if (!is_array($this->value)) {
            $this->value = json_decode($this->value, true);
        }
        $this->attributes[] = " data-field=\"{$this->fieldId}\"";

        if (empty($this->value)) {
            $this->value = array('');
        }

        for ($i = 0; $i < count($this->value); $i++) {
            if ($i != 0) {
                echo '<tr valign="top" data-field="' . $this->fieldId . '" data-idx="' . $i . '"><th scope="row">&nbsp;</th>';
            }
            echo '<td>';
            $this->generateFields($this->value[$i], $i);
            echo "</td></tr>";
        }

        $output = ob_get_contents();
        ob_end_clean();

        echo "<tr class=\"repeatable-template\" id=\"{$this->fieldId}_template\" data-field=\"{$this->fieldId}\" data-new-id=\"{$i}\" valign=\"top\">";
        echo "<th scope=\"row\">&nbsp;</th>";
        echo '<td>';
        $this->generateFields();
        echo '</td></tr>';

        echo $output;
    }

    abstract protected function generateFields($val = '', $idx = 'template');
}