<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Field/Collection.php
 * @since      File available since Release 1.0.0
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
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @since      Class available since Release 1.0.0
 */
abstract class Collection extends Field
{
    /**
     *
     * @var type
     */
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
