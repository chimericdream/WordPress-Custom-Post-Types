<?php
/**
 * Short description for file
 *
 * @package    WPCPT\Autoloader
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.0.0
 */
namespace WPCPT;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\Autoloader
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Autoloader
{
    /**
     *
     * @var type
     */
    protected static $prefixes = array(
        'WPCPT',
    );

    /**
     *
     * @var type
     */
    protected static $directories = array(
        __DIR__,
    );

    /**
     *
     * @param type $prefix
     * @param type $dir
     */
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

    /**
     *
     * @param type $class
     */
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
