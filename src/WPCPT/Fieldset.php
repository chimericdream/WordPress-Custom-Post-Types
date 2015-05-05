<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Fieldset
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.0.0
 */
namespace WPCPT;

use \WPCPT\Field;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType\Fieldset
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Fieldset
{
    /**
     *
     * @var type
     */
    protected $fields = array();

    /**
     *
     * @param Field $field
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    /**
     *
     * @return type
     */
    public function render()
    {
        if (empty($this->fields)) {
            return;
        }
        echo '<table class="form-table">';
        foreach ($this->fields as $f) {
            $f->render();
        }
        echo '</table>';
    }
}
