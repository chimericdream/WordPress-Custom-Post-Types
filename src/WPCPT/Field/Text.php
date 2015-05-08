<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Field/Text.php
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
class Text extends Field
{
    /**
     *
     */
    public function renderField()
    {
        echo '<input type="text" id="' . $this->fieldId . '" name="' . $this->getNameAttribute() . '"';
        $this->renderAttributes();
        echo ' value="' . $this->value . '">';
        if (!empty($this->note)) {
            echo '<p class="description">' . $this->note . '</p>';
        }
    }
}
