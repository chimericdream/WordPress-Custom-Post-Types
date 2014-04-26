<?php
abstract class WPCPT_PostType {
    public static $menuSeparators = array();
    protected $menuOrder          = array();
    protected $name               = '';
    protected $options            = array();
    protected $defaults           = array(
        'label'                => '',
        'label_plural'         => '',
        'description'          => '',
        'public'               => true,
        'publicly_queryable'   => true,
        'exclude_from_search'  => false,
        'show_ui'              => true,
        'show_in_menu'         => true,
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
            'post-formats'     //
        ),
        'taxonomies'           => array(),
        'has_archive'          => false,
        'rewrite'              => false,
        'shortcodes'           => array()
    );

    public function __construct() {
        $this->options = array_merge($this->defaults, $this->options);
        $this->register();
        $this->setupShortcodes();
    }

    public static function getAll($postType = '', $atts = array()) {
        if (empty($postType)) {
            return array();
        }

        extract(shortcode_atts(
                array(
                    'perPage' => -1,
                    'status'  => 'publish',
                ),
                $atts
            )
        );

        $args = array(
            'posts_per_page'  => $perPage,
            'post_type'       => $postType,
            'post_status'     => $status,
        );

        return get_posts($args);
    }

    public static function getOne($postType = '', $atts = array()) {
        if (empty($postType)) {
            return array();
        }

        extract(shortcode_atts(
                array(
                    'slug'   => NULL,
                    'id'     => NULL,
                    'status' => 'publish',
                ),
                $atts
            )
        );
        if ($slug === NULL && $id === NULL) {
            return '';
        }

        $args = array(
            'posts_per_page'  => 1,
            'post_type'       => $postType,
            'post_status'     => $status,
        );

        if ($id != NULL) {
            $args['p'] = $id;
        } else {
            $args['name'] = $slug;
        }

        return get_posts($args);
    }

    protected function register() {
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
        register_post_type($this->name, $opts);
        add_action('save_post', array($this, 'savePost'));
    }

    protected function verifyThemeSupport() {
        if (!current_theme_supports('post-thumbnails') && in_array('thumbnail', $this->options['supports'])) {
            add_theme_support('post-thumbnails');
        }
        if (!current_theme_supports('post-formats') && in_array('post-formats', $this->options['supports'])) {
            add_theme_support('post-formats');
        }
    }

    protected function generateLabels() {
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

    abstract public function addMetaBoxes();
    abstract public function savePost($post_id);

    protected function setNonce() {
        $noncefield = $this->name . '_meta_nonce';
        wp_nonce_field(plugin_basename(__FILE__), $noncefield);
    }

    protected function verifyBeforeSave($post_id) {
        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || empty($_POST)) {
            return false;
        }

        $noncefield = $this->name . '_meta_nonce';

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if (empty($_POST[$noncefield]) || !wp_verify_nonce($_POST[$noncefield], plugin_basename(__FILE__))) {
            return false;
        }

        // Check permissions
        if (!current_user_can('edit_page', $post_id)) {
            return false;
        }

        return true;
    }

    protected function getMeta($name) {
        $id = $this->post_id;
        return get_post_meta($id, $name, true);
    }

    protected function setMeta($name, $value = NULL) {
        $id = $this->post_id;
        if ($value === NULL) {
            $value = $this->getPostVar($name);
        }
        update_post_meta($id, $name, $value);
    }

    protected function getPostVar($name) {
        if (array_key_exists($name, $_POST)) {
            return $_POST[$name];
        }
        return NULL;
    }

    protected function setupShortcodes() {
        foreach ($this->options['shortcodes'] as $code => $func) {
            add_shortcode($code, array($this, $func));
        }
    }
}