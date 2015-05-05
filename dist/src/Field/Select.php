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
class Select extends Field
{
    /**
     *
     */
    public function renderField()
    {
        echo '<select id="' . $this->fieldId . '" name="' . $this->getNameAttribute() . '"';
        $this->renderAttributes();
        echo '>';
        if (array_values($this->options) === $this->options) {
            foreach ($this->options as $v) {
                echo '<option value="' . $v . '"';
                if ($this->value == $v) {
                    echo ' selected="selected"';
                }
                echo ">{$v}</option>";
            }
        } else {
            foreach ($this->options as $k => $v) {
                echo '<option value="' . $k . '"';
                if ($this->value == $k) {
                    echo ' selected="selected"';
                }
                echo ">{$v}</option>";
            }
        }
        echo '</select>';
        if (!empty($this->note)) {
            echo '<p class="description">' . $this->note . '</p>';
        }
    }
}
