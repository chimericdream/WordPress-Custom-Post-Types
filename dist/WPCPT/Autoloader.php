<?php
/**
 * Contains the Autoloader class
 *
 * @package    WPCPT\Autoloader
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       https://github.com/chimericdream/WordPress-Custom-Post-Types/blob/master/src/WPCPT/Autoloader.php
 * @since      File available since Release 1.0.0
 */
namespace WPCPT;

/**
 * The Autoloader eliminates the need to `require` or `include` every individual
 * PHP file to be used.
 *
 * _Note:_ This Autoloader assumes a valid PSR-4 directory structure. See the
 * [PHP FIG documentation regarding PSR-4 standards](http://www.php-fig.org/psr/psr-4/) for more information. For
 * more information about autoloading in PHP, see the [PHP.net page on the topic](http://php.net/manual/en/language.oop5.autoload.php).
 *
 * @package    WPCPT\Autoloader
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @since      Class available since Release 1.0.0
 */
class Autoloader
{
    /**
     * This array stores the mapping of class prefixes (or namespaces) to the
     * directory in which those files are stored. See {@link addPrefix}
     * for instructions on how to register namespaces or prefixes.
     *
     * @var array
     */
    protected static $prefixes = array(
        'WPCPT' => __DIR__
    );

    /**
     * Registers the autoloader with PHP.
     */
    public function register()
    {
        spl_autoload_register(array(get_class($this), 'load'));
    }

    /**
     * Adds a prefix or namespace for the autoloader to check when looking for
     * a class.
     *
     * A prefix can either be a first-level namespace or the first term of a
     * class name that uses underscores to indicate its directory structure
     * (such as the Zend Framework).
     *
     * Example:
     * ```
     * $autoloader->addPrefix('MyNamespace', '/some/path/here');
     *
     * // Both of the following will be looked for in the path above. The Autoloader will look for
     * // the file "/some/path/here/MyNamespace/SomeClass.php"
     * $class1 = new \MyNamespace\SomeClass();
     * $class2 = new MyNamespace_SomeClass();
     * ```
     *
     * @param string $prefix The first-level namespace or first term of the class structure
     * @param string $dir    The highest-level folder for the namespace
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
