<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Field/Textarea.php
 * @since      File available since Release 1.0.0
 */
namespace WPCPT\Field;

use \WPCPT\Field;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType\Field
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @since      Class available since Release 1.0.0
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
