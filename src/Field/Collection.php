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
use \WPCPT\Fieldset;

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
abstract class Collection extends Field
{
    protected $options = array();

    /**
     *
     * @param type $options
     * @return \WPCPT\Field\Collection
     */
    public function __construct($options = array())
    {
        $this->options = $options;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function render()
    {
        return '';
    }

    /**
     *
     */
    abstract public function setFields(Fieldset &$fs);
}
