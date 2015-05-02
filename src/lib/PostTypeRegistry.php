<?php
namespace WPCPT;

abstract class PostTypeRegistry
{
    protected $postTypes      = array();
    protected $menuSeparators = array();
    protected $registry       = array();

    public function __construct()
    {
        $this->registerPostTypes();
        $this->setupActions();
    }

    protected function registerPostTypes()
    {
        foreach ($this->postTypes as $k => $v) {
            $c = $v['class'];
            $this->registry[$k] = new $c();
        }
    }

    protected function setupActions()
    {
        add_action('post_edit_form_tag', array($this, 'editFormTag'));
        add_action('admin_menu', array($this, 'menuSeparators'));
    }

    public function editFormTag()
    {
        echo ' enctype="multipart/form-data"';
    }

    public function menuSeparators()
    {
        foreach ($this->menuSeparators as $idx) {
            $this->addMenuSeparator($idx);
        }
    }

    public function addMenuSeparator($position)
    {
        global $menu;
        $index = 0;

        foreach ($menu as $offset => $section) {
            if (substr($section[2], 0, 9) == 'separator') {
                $index++;
            }
            if ($offset >= $position) {
                $menu[$position] = array('', 'read', "separator{$index}", '', 'wp-menu-separator');
                break;
            }
        }

        ksort($menu);
    }
}
