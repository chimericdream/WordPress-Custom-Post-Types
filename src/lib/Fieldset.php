<?php
namespace WPCPT;

class Fieldset
{
    protected $fields = array();

    public function addField(WpCpt_Field $field)
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
