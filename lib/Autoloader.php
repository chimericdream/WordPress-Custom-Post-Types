<?php
class WCPT_Autoloader {
    public static function load($class) {
        $class = str_replace('WCPT_', '', $class);
        $class = str_replace('_', '/', $class);
        if (is_readable(dirname(__FILE__) . "/{$class}.php")) {
            require_once dirname(__FILE__) . "/{$class}.php";
        }
    }
}

spl_autoload_register('WCPT_Autoloader::load');