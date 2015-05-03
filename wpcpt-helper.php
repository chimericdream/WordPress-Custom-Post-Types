<?php
/**
 * Plugin Name: WordPress Custom Post Types Helper
 * Plugin URI: http://chimericdream.com/
 * Description: This plugin aids in the creation of custom post types, taxonomies, shortcodes, and more.
 * Version: 1.3.0
 * Author: Bill Parrott
 * Author URI: http://chimericdream.com/
 * License: MIT
 */
namespace WPCPT;

require_once dirname(__FILE__) . '/src/Autoloader.php';
$wpcpt_autoloader = new Autoloader();

add_action('init', 'wpcpt_init');

function wpcpt_init() {
    do_action('wpcpt_init');
}