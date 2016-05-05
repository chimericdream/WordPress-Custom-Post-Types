<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field\Common
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Field/Common/YesNoNa.php
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
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @since      Class available since Release 1.0.0
 */
class YesNoNa extends Radio
{
    /**
     *
     * @var type
     */
    protected $options = array(
        1 => 'Yes',
        0 => 'No',
        -1 => 'n/a',
    );
}
