<?php
/**
 * Short description for file
 *
 * @package    WPCPT\Autoloader
 * @author     {{@wpcpt_author_full}}
 * @copyright  {{@wpcpt_copyright}}
 * @license    {{@wpcpt_license}}
 * @version    {{@wpcpt_version}}
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Autoloader.php
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
 * @since      Class available since Release 1.0.0
 */
class Autoloader
{
    /**
     *
     * @var type
     */
    protected static $prefixes = array(
        'WPCPT' => __DIR__
    );

    /**
     *
     */
    public function __construct()
    {
        spl_autoload_register(array(get_class($this), 'load'));
    }

    /**
     *
     * @param type $prefix
     * @param type $dir
     */
    public function addPrefix($prefix, $dir)
    {
        self::$prefixes[$prefix] = $dir;
    }

    /**
     *
     * @param type $class
     */
    public static function load($class)
    {
        $c = str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $class);

        $prefix = self::getPrefix($c);
        if (is_null($prefix) || !array_key_exists($prefix, self::$prefixes)) {
            return;
        }

        $filename = self::getFilename($prefix, $c);
        if (is_readable($filename)) {
            require_once $filename;
        }
    }

    /**
     *
     * @param type $class
     * @return type
     */
    public static function getPrefix($class)
    {
        $pieces = explode(DIRECTORY_SEPARATOR, $class);
        if (empty($pieces)) {
            return null;
        }
        return $pieces[0];
    }

    /**
     *
     * @param type $prefix
     * @param type $class
     * @return type
     */
    public static function getFilename($prefix, $class)
    {
        $filename = str_replace($prefix, '', $class);
        return self::$prefixes[$prefix] . $filename . '.php';
    }
}
