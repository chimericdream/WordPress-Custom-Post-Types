<?php
namespace WPCPT\Field\Common;

use WPCPT\Field\Radio;

class YesNoNa extends Radio
{
    protected $options = array(
        1 => 'Yes',
        0 => 'No',
        -1 => 'n/a',
    );
}
