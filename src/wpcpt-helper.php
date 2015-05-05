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
