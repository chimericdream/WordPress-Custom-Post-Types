<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field\Common
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Field/Common/YesNo.php
 * @since      File available since Release 1.0.0
 */
namespace WPCPT\Field\Common;

use \WPCPT\Field\Radio;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType\Field\Common
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @since      Class available since Release 1.0.0
 */
class YesNo extends Radio
{
    /**
     *
     * @var type
     */
    protected $options = array(
        1 => 'Yes',
        0 => 'No',
    );
}
