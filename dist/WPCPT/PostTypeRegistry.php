<?php
/**
 * Contains the PostTypeRegistry class
 *
 * @package    WPCPT\PostType
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/PostTypeRegistry.php
 * @since      File available since Release 1.0.0
 */
namespace WPCPT;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @since      Class available since Release 1.0.0
 */
abstract class PostTypeRegistry
{
    /**
     *
     * @var type
     */
    protected $postTypes      = array();

    /**
     *
     * @var type
     */
    protected $menuSeparators = array();

    /**
     *
     * @var type
     */
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
