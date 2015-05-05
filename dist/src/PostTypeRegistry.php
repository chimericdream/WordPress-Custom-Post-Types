<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * LICENSE: Some license information
 *
 * @package    Zend_Magic
 * @subpackage Wand
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
 * @package    Zend_Magic
 * @subpackage Wand
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
abstract class PostTypeRegistry
{
    protected $postTypes      = array();
    protected $menuSeparators = array();
    protected $registry       = array();

    /**
     *
     */
    public function __construct()
    {
        $this->registerPostTypes();
        $this->setupActions();
    }

    /**
     *
     */
    protected function registerPostTypes()
    {
        foreach ($this->postTypes as $k => $v) {
            $c = $v['class'];
            $this->registry[$k] = new $c();
        }
    }

    /**
     *
     */
    protected function setupActions()
    {
        \add_action('post_edit_form_tag', array($this, 'editFormTag'));
        \add_action('admin_menu', array($this, 'menuSeparators'));
    }

    /**
     *
     */
    public function editFormTag()
    {
        echo ' enctype="multipart/form-data"';
    }

    /**
     *
     */
    public function menuSeparators()
    {
        foreach ($this->menuSeparators as $idx) {
            $this->addMenuSeparator($idx);
        }
    }

    /**
     *
     * @global type $menu
     * @param type $position
     */
    public function addMenuSeparator($position)
    {
        global $menu;
        $index = 0;

        foreach ($menu as $offset => $section) {
            if (substr($section[2], 0, 9) == 'separator') {
                $index++;
            }
            if ($offset >= $position) {
                $menu[$position] = array(
                    '',
                    'read',
                    "separator{$index}",
                    '',
                    'wp-menu-separator'
                );
                break;
            }
        }

        ksort($menu);
    }
}
