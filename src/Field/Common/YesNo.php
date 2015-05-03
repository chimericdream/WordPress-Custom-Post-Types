<?php
namespace WPCPT\Field\Common;

use \WPCPT\Field\Radio;

class YesNo extends Radio
{
    protected $options = array(
        1 => 'Yes',
        0 => 'No',
    );
}
