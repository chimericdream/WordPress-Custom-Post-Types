<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.0.0
 */
namespace WPCPT;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0.0
 */
abstract class PostType
{
    /**
     *
     * @var type
     */
    protected $menuOrder          = array();

    /**
     *
     * @var type
     */
    protected $name               = '';

    /**
     *
     * @var type
     */
    protected $options            = array();

    /**
     *
     * @var type
     */
    protected $defaults           = array(
        'label'                => '',
        'label_plural'         => '',
        'description'          => '',
        'public'               => true,
        'publicly_queryable'   => true,
        'exclude_from_search'  => false,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'submenu_pages'        => array(),
        'menu_icon'            => null,
        'capability_type'      => 'page',
        'supports'             => array(
            'title',           //
            'editor',          // (content)
            'author',          //
            'thumbnail',       // (featured image, current theme must also support post-thumbnails)
            'excerpt',         //
            'trackbacks',      //
            'custom-fields',   //
            'comments',        // (also will see comment count balloon on edit screen)
            'revisions',       // (will store revisions)
            'page-attributes', // (menu order, hierarchical must be true to show Parent option)
            'post-formats',    //
            'wpcom-markdown',  // Markdown support via Jetpack
        ),
        'taxonomies'           => array(),
        'has_archive'          => false,
        'rewrite'              => false,
    );

    /**
     *
     */
    public function __construct()
    {
        $this->options = array_merge($this->defaults, $this->options);
        $this->register();
    }

    /**
     *
     * @param type $name
     * @return type
     */
    public function getOption($name)
    {
        if (array_key_exists($name, $this->options)) {
            return $this->options[$name];
        }
        return null;
    }

    /**
     *
     * @param type $postType
     * @param type $atts
     * @return type
     */
    public static function getAll($postType = '', $atts = array())
    {
        if (empty($postType)) {
            return array();
        }

        extract(\shortcode_atts(
            array(
                'perPage' => -1,
                'status'  => 'publish',
            ),
            $atts
        ));

        $args = array(
            'posts_per_page'  => $perPage,
            'post_type'       => $postType,
            'post_status'     => $status,
        );

        return get_posts($args);
    }

    /**
     *
     * @param type $postType
     * @param type $atts
     * @return string
     */
    public static function getOne($postType = '', $atts = array())
    {
        if (empty($postType)) {
            return array();
        }

        extract(\shortcode_atts(
            array(
                'slug'   => null,
                'id'     => null,
                'status' => 'publish',
            ),
            $atts
        ));
        if ($slug === null && $id === null) {
            return '';
        }

        $args = array(
            'posts_per_page'  => 1,
            'post_type'       => $postType,
            'post_status'     => $status,
        );

        if ($id != null) {
            $args['p'] = $id;
        } else {
            $args['name'] = $slug;
        }

        return \get_posts($args);
    }

    /**
     *
     */
    protected function register()
    {
        $this->verifyThemeSupport();
        $opts = array(
            'labels'               => $this->generateLabels(),
            'description'          => $this->options['description'],
            'public'               => $this->options['public'],
            'publicly_queryable'   => $this->options['publicly_queryable'],
            'exclude_from_search'  => $this->options['exclude_from_search'],
            'show_ui'              => $this->options['show_ui'],
            'show_in_menu'         => $this->options['show_in_menu'],
            'menu_position'        => $this->menuOrder[$this->name],
            'menu_icon'            => $this->options['menu_icon'],
            'capability_type'      => $this->options['capability_type'],
            'supports'             => $this->options['supports'],
            'register_meta_box_cb' => array($this, 'addMetaBoxes'),
            'has_archive'          => $this->options['has_archive'],
            'taxonomies'           => $this->options['taxonomies'],
            'rewrite'              => $this->options['rewrite']
        );
        if (is_string($opts['show_in_menu'])) {
            $opts['show_in_menu'] = 'edit.php?post_type=' . $opts['show_in_menu'];
        }
        \register_post_type($this->name, $opts);
        $this->addActions();
    }

    /**
     *
     */
    private function addActions()
    {
        \add_action('save_post', array($this, 'savePost'));
        if (!empty($this->options['submenu_pages'])) {
            \add_action('admin_menu', array($this, 'adminMenu'));
        }
    }

    /**
     *
     */
    public function adminMenu()
    {
        foreach ($this->options['submenu_pages'] as $p) {
            $opts = array(
                'parent'     => 'edit.php?post_type=' . $p['parent'],
                'page-title' => $this->options['label_plural'],
                'menu-title' => 'All ' . $this->options['label_plural'],
                'capability' => 'edit_' . $this->options['capability_type'] . 's',
                'function'   => 'edit.php?&post_type=' . $this->name,
            );
            if (!empty($p['tax-function'])) {
                $opts['function'] = 'edit-tags.php?taxonomy=' . $p['tax-function'] . '&post_type=' . $this->name;
            }
            \add_submenu_page(
                $opts['parent'],
                $opts['page-title'],
                $opts['menu-title'],
                $opts['capability'],
                $opts['function']
            );
        }
    }

    /**
     *
     */
    protected function verifyThemeSupport()
    {
        if (!\current_theme_supports('post-thumbnails') && in_array('thumbnail', $this->options['supports'])) {
            \add_theme_support('post-thumbnails');
        }
        if (!\current_theme_supports('post-formats') && in_array('post-formats', $this->options['supports'])) {
            \add_theme_support('post-formats');
        }
    }

    /**
     *
     * @return string
     */
    protected function generateLabels()
    {
        $l  = $this->options['label'];
        $ls = $this->options['label_plural'];
        $labels = array(
            'name'               => $ls,
            'singular_name'      => $l,
            'add_new'            => 'Add New ' . $l,
            'all_items'          => 'All ' . $ls,
            'add_new_item'       => 'Add New ' . $l,
            'edit_item'          => 'Edit ' . $l,
            'new_item'           => '',
            'view_item'          => 'View',
            'search_items'       => '',
            'not_found'          => '',
            'not_found_in_trash' => '',
            'parent_item'        => null,
            'parent_item_colon'  => null,
            'menu_name'          => $ls,
        );
        return $labels;
    }

    /**
     *
     */
    abstract public function addMetaBoxes();

    /**
     *
     */
    abstract public function savePost($post_id);

    /**
     *
     */
    protected function setNonce()
    {
        $noncefield = $this->name . '_meta_nonce';
        \wp_nonce_field(\plugin_basename(__FILE__), $noncefield);
    }

    /**
     *
     * @param type $post_id
     * @return boolean
     */
    protected function verifyBeforeSave($post_id)
    {
        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || empty($_POST)) {
            return false;
        }

        $nonce = filter_input(INPUT_POST, $this->name . '_meta_nonce', FILTER_SANITIZE_STRING);

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if (!\wp_verify_nonce($nonce, \plugin_basename(__FILE__))) {
            return false;
        }

        // Check permissions
        if (!\current_user_can('edit_page', $post_id)) {
            return false;
        }

        return true;
    }

    /**
     *
     * @param type $name
     * @return type
     */
    protected function getMeta($name)
    {
        $id = $this->post_id;
        return \get_post_meta($id, $name, true);
    }

    /**
     *
     * @param type $name
     * @param type $value
     */
    protected function setMeta($name, $value = null)
    {
        $id = $this->post_id;
        if ($value === null) {
            $value = $this->getPostVar($name);
        }
        \update_post_meta($id, $name, $value);
    }

    /**
     *
     * @param type $name
     * @return type
     */
    protected function getPostVar($name)
    {
        return filter_input(INPUT_POST, $name);
    }
}
