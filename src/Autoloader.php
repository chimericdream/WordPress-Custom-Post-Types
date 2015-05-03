<?php
namespace WPCPT;

class Autoloader
{
    protected static $prefixes = array(
        'WPCPT',
    );

    protected static $directories = array(
        __DIR__,
    );

    public function __construct($prefix = '', $dir = '')
    {
        if (!empty($prefix)) {
            self::$prefixes[] = $prefix;
        }
        if (!empty($dir)) {
            self::$directories[] = $dir;
        }
        spl_autoload_register(array(get_class($this), 'load'));
    }

    public static function load($class)
    {
        foreach (self::$prefixes as $idx => $prefix) {
            $c = str_replace($prefix, '', $class);
            $c = str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $c);
            $c = self::$directories[$idx] . "/{$c}.php";
            if (is_readable($c)) {
                require_once $c;
            }
        }
    }
}
