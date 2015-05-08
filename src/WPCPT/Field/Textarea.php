<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
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
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
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
