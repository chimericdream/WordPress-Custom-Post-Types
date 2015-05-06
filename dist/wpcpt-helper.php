<?php
/**
 * Plugin Name: WordPress Custom Post Types Helper
 * Plugin URI: https://github.com/chimericdream/WordPress-Custom-Post-Types
 * Description: This plugin aids in the creation of custom post types, taxonomies, shortcodes, and more.
 * Version: 2.0.0a
 * Author: Bill Parrott
 * Author URI: http://chimericdream.com/
 * License: http://opensource.org/licenses/MIT
 */
require_once dirname(__FILE__) . '/WPCPT/Autoloader.php';
$wpcpt_autoloader = new \WPCPT\Autoloader();

add_action('init', function () {
    do_action('wpcpt_init');
});

add_action('wpcpt_add_autoload', function ($prefix, $dir) {
    global $wpcpt_autoloader;
    $wpcpt_autoloader->addPrefix($prefix, $dir);
}, 10, 2);