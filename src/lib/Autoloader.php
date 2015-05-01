<?php
class WPCPT_Autoloader {
    protected static $prefixes = array(
        'WPCPT_',
    );

    protected static $directories = array(
        __DIR__,
    );

    public function __construct($prefix = '', $dir = '') {
        if (!empty($prefix) && !empty($dir)) {
            self::$prefixes[]    = $prefix;
            self::$directories[] = $dir;
        }
        spl_autoload_register(array(get_class($this), 'load'));
    }

    public static function load($class) {
        foreach (self::$prefixes as $idx => $prefix) {
            $c = str_replace($prefix, '', $class);
            $c = str_replace('_', '/', $c);
            $c = self::$directories[$idx] . "/{$c}.php";
            if (is_readable($c)) {
                require_once $c;
            }
        }
    }
}