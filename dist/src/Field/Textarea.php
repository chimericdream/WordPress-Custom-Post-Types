<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * LICENSE: Some license information
 *
 * @package    Zend_Magic
 * @subpackage Wand
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.5.0
 */
namespace WPCPT\Field;

use \WPCPT\Field;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Zend_Magic
 * @subpackage Wand
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
class Textarea extends Field
{
    /**
     *
     */
    public function renderField()
    {
        $this->options = array_merge(
            array(
                'media_buttons' => false,
                'textarea_rows' => 5,
            ),
            $this->options
        );
        \wp_editor($this->value, $this->fieldId, $this->options);
    }
}
