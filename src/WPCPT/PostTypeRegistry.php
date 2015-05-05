<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @package    WPCPT\PostType
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
 * @package    WPCPT\PostType
 * @author     {{@wpcpt_author}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
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
