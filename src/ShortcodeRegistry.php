<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @package    WPCPT\Shortcode
 * @author     {{@wpcpt_author}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
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
 * @author     {{@wpcpt_author}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
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
