<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       http://framework.zend.com/package/PackageName
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
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
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
