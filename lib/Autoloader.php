<?php
class WPCPT_Autoloader {
    public static function load($class) {
        $class = str_replace('WPCPT_', '', $class);
        $class = str_replace('_', '/', $class);
        if (is_readable(dirname(__FILE__) . "/{$class}.php")) {
            require_once dirname(__FILE__) . "/{$class}.php";
        }
    }

    public static function loadFromDependents($class) {
        $class = str_replace('_', '/', $class);

        global $wpcpt_autoload_helper;
        foreach ($wpcpt_autoload_helper->getDirectories() as $dir) {
            $c = str_replace($dir['prefix'], '', $class);
            $c = "{$dir['name']}/{$c}.php";
            if (is_readable($c)) {
                require_once $c;
            }
        }
    }
}

spl_autoload_register('WPCPT_Autoloader::load');
spl_autoload_register('WPCPT_Autoloader::loadFromDependents');