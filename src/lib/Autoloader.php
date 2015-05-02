<?php
namespace WPCPT;

class Autoloader
{
    protected static $directories = array(
        __DIR__,
    );

    public function __construct($dir = '')
    {
        if (!empty($dir)) {
            self::$directories[] = $dir;
        }
        spl_autoload_register(array(get_class($this), 'load'));
    }

    public static function load($class)
    {
        foreach (self::$directories as $dir) {
            $c = $dir . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
            if (is_readable($c)) {
                require_once $c;
            }
        }
    }
}
