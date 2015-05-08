<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Field/Select.php
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
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @since      Class available since Release 1.0.0
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
