<?php
/**
 * Plugin Name: {{@wpcpt_longname}}
 * Plugin URI: {{@wpcpt_homepage}}
 * Description: {{@wpcpt_description}}
 * Version: {{@wpcpt_version}}
 * Author: {{@wpcpt_author_name}}
 * Author URI: {{@wpcpt_author_url}}
 * License: {{@wpcpt_license}}
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