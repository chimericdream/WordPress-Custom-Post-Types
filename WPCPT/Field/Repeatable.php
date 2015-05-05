<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @package    WPCPT\PostType\Field
 * @author     {{@wpcpt_author}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
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
 * @package    WPCPT\PostType\Field
 * @author     {{@wpcpt_author}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
abstract class Repeatable extends Field
{
    /**
     *
     */
    public function render()
    {
        ob_start();

        echo '<tr valign="top" data-field="' . $this->fieldId . '" data-idx="0">';
        $this->showLabel();
        if (!is_array($this->value)) {
            $this->value = json_decode($this->value, true);
        }
        $this->attributes[] = ' data-field="' . $this->fieldId . '"';

        if (empty($this->value)) {
            $this->value = array('');
        }

        for ($i = 0; $i < count($this->value); $i++) {
            if ($i != 0) {
                echo '<tr valign="top" data-field="' . $this->fieldId
                   . '" data-idx="' . $i . '"><th scope="row">&nbsp;</th>';
            }
            echo '<td>';
            $this->generateFields($this->value[$i], $i);
            echo '</td></tr>';
        }

        $output = ob_get_contents();
        ob_end_clean();

        echo '<tr class="repeatable-template" id="' . $this->fieldId
           . '_template" data-field="' . $this->fieldId
           . '" data-new-id="' . $i . '" valign="top">'
           . '<th scope="row">&nbsp;</th><td>';
        $this->generateFields();
        echo '</td></tr>';

        echo $output;
    }

    /**
     *
     */
    abstract protected function generateFields($val = '', $idx = 'template');
}
