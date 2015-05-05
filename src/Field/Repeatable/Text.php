<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @package    WPCPT\PostType\Field\Repeatable
 * @author     {{@wpcpt_author}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.5.0
 */
namespace WPCPT\Field\Repeatable;

use \WPCPT\Field\Repeatable;
use \WPCPT\Field\Text as TextField;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType\Field\Repeatable
 * @author     {{@wpcpt_author}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
class Text extends Repeatable
{
    /**
     *
     * @param type $val
     * @param type $idx
     */
    protected function generateFields($val = '', $idx = null)
    {
        $field = new TextField($val);
        $atts = array(
            'data-id'    => $this->fieldId . '_{x}',
            'data-name'  => $this->fieldId . '[{x}]',
            'data-field' => $this->fieldId,
        );
        if ($idx !== null) {
            $atts['data-idx'] = $idx;
        }
        $field->setId('')
              ->setAttributes($atts)
              ->renderField();
        echo " <a class=\"icon-add\" data-add=\"{$this->fieldId}\" href=\"#\">Add</a>";
        if ($idx !== 0) {
            echo " <a class=\"icon-remove\" data-remove=\"{$this->fieldId}\" href=\"#\">Remove</a>";
        }
    }
}
