<?php
/**
 * Plugin Name: WordPress Custom Post Types Helper
 * Plugin URI: http://chimericdream.com/
 * Description: This plugin aids in the creation of custom post types, taxonomies, shortcodes, and more.
 * Version: 2.0.0a
 * Author: Bill Parrott
 * Author URI: http://chimericdream.com/
 * License: MIT
 */
require_once dirname(__FILE__) . '/src/WPCPT/Autoloader.php';
$wpcpt_autoloader = new \WPCPT\Autoloader();

add_action('init', function () {
    do_action('wpcpt_init');
});
