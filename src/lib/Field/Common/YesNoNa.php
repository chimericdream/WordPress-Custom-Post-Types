<?php
class WPCPT_Field_Common_YesNoNa extends WPCPT_Field_Radio
{
    protected $options = array(
        1 => 'Yes',
        0 => 'No',
        -1 => 'n/a',
    );
}
