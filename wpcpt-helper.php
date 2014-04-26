<?php
/**
 * Plugin Name: WordPress Custom Post Types Helper
 * Plugin URI: http://chimericdream.com/
 * Description: This plugin aids in the creation of custom post types, taxonomies, shortcodes, and more.
 * Version: 1.0a
 * Author: Bill Parrott
 * Author URI: http://chimericdream.com/
 * License: MIT
 */

require_once dirname(__FILE__) . '/lib/Autoloader.php';
$wpcpt_autoloader = new WPCPT_Autoloader();

add_action('init', 'wpcpt_init');

function wpcpt_init() {
    do_action('wpcpt_init');
}