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
class Radio extends Field
{
    /**
     *
     */
    public function renderField()
    {
        if (empty($this->fieldName)) {
            $this->fieldName = $this->fieldId;
        }
        $keys     = array_keys($this->options);
        $keycount = count($keys);
        for ($i = 0; $i < $keycount; $i++) {
            echo ($i === 0) ? '<br>' : '';
            echo '<label><input';
            echo ($i === 0) ? ' id="' . $this->fieldId . '"' : '';
            echo ' type="radio" name="' . $this->fieldName . '" value="' . $keys[$i] . '"';
            echo ($this->value == $keys[$i]) ? ' checked="checked"' : '';
            echo "> {$this->options[$keys[$i]]}</label>";
        }
    }
}