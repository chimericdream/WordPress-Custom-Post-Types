<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @package    WPCPT\PostType\Field\Repeatable
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.5.0
 */
namespace WPCPT\Field\Repeatable;

use \WPCPT\Field\Repeatable;
use \WPCPT\Field\Select;
use \WPCPT\Field\Text;
use \WPCPT\Field\Textarea\NoWysiwyg;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType\Field\Repeatable
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
class Group extends Repeatable
{
    protected $fields = array();

    /**
     *
     * @param type $fields
     */
    public function setFields($fields = array())
    {
        $this->fields = $fields;
    }

    /**
     *
     * @param type $val
     * @param type $idx
     */
    protected function generateFields($val = '', $idx = 'template')
    {
        foreach ($this->fields as $f) {
            if (is_array($f)) {
                $v = '';
                if (is_array($val) && array_key_exists($f['name'], $val)) {
                    $v = $val[$f['name']];
                }
                if (!array_key_exists('atts', $f)) {
                    $f['atts'] = array();
                }
                $f['atts']['data-id']    = $this->fieldId . '_{x}_' . $f['name'];
                $f['atts']['data-name']  = $this->fieldId . '[{x}][' . $f['name'] . ']';
                $f['atts']['data-field'] = $this->fieldId;
                if ($idx !== 'template') {
                    $f['atts']['data-idx'] = $idx;
                }
                switch($f['type']) {
                    case 'select':
                        $field = new Select($v);
                        $field->setOptions($f['options'])->setAttributes($f['atts'])->renderField();
                        break;
                    case 'text':
                        $field = new Text($v);
                        $field->setAttributes($f['atts'])->renderField();
                        break;
                    case 'textarea':
                        $field = new NoWysiwyg($v);
                        $field->setAttributes($f['atts'])->renderField();
                        break;
                }
            } else {
                echo $f;
            }
        }
        echo " <a class=\"icon-add\" data-add=\"{$this->fieldId}\" href=\"#\">Add</a>";
        if ($idx !== 0) {
            echo " <a class=\"icon-remove\" data-remove=\"{$this->fieldId}\" href=\"#\">Remove</a>";
        }
    }
}
