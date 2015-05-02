<?php
class WPCPT_Fieldset
{
    protected $fields = array();

    public function addField(WPCPT_Field $field)
    {
        $this->fields[] = $field;
    }

    public function render()
    {
        if (empty($this->fields)) {
            return;
        }
        echo '<table class="form-table">';
        foreach ($this->fields as $f) {
            $f->render();
        }
        echo '</table>';
    }
}
