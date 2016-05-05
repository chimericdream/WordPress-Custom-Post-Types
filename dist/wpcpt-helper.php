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
$loader = new \WPCPT\Autoloader();
$loader->register();

add_action('init', function () {
    do_action('wpcpt_init');
});

add_action('wpcpt_add_autoload', function ($prefix, $dir) {
    global $loader;
    $loader->addPrefix($prefix, $dir);
}, 10, 2);