<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @package    WPCPT\Shortcode
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.5.0
 */
namespace WPCPT;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\Shortcode
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
abstract class ShortcodeRegistry
{
    protected $wpcpt_shortcodes = array(
        'wpcpt-raw' => array(
            'class' => '\WPCPT\Shortcode\Raw',
        ),
    );
    protected $shortcodes       = array();
    protected $registry         = array();

    /**
     *
     */
    public function __construct()
    {
        $this->registerShortcodes();
    }

    /**
     *
     */
    protected function registerShortcodes()
    {
        foreach ($this->shortcodes as $k => $v) {
            $c = $v['class'];
            $this->registry[$k] = new $c();
        }
        foreach ($this->wpcpt_shortcodes as $k => $v) {
            $c = $v['class'];
            $this->registry[$k] = new $c();
        }
    }
}
