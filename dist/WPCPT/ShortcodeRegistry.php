<?php
/**
 * Contains the ShortcodeRegistry class
 *
 * @package    WPCPT\Shortcode
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/ShortcodeRegistry.php
 * @since      File available since Release 1.1.0
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
 * @since      Class available since Release 1.1.0
 */
abstract class ShortcodeRegistry
{
    /**
     *
     * @var type
     */
    protected $wpcpt_shortcodes = array(
        'wpcpt-raw' => array(
            'class' => '\WPCPT\Shortcode\Raw',
        ),
    );

    /**
     *
     * @var type
     */
    protected $shortcodes       = array();

    /**
     *
     * @var type
     */
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
