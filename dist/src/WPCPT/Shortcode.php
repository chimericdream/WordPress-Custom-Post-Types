<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * @package    WPCPT\Shortcode
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.5.0
 */
namespace WPCPT;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\Shortcode
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
abstract class Shortcode
{
    protected $name;

    /**
     *
     */
    public function __construct()
    {
        \add_shortcode($this->name, array($this, 'run'));
    }

    /**
     *
     * @return type
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public static function getCallingPage()
    {
        $scriptUri  = filter_input(INPUT_SERVER, 'SCRIPT_URI', FILTER_SANITIZE_URL);
        $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        if (strpos($scriptUri, $requestUri) !== false) {
            $page = $scriptUri;
        } else {
            $page = substr($scriptUri, 0, -1) . $requestUri;
        }
        return $page;
    }

    /**
     *
     * @global type $wpdb
     * @param type $shortcode
     * @param type $calling_page
     * @return type
     */
    public static function getDupes($shortcode, $calling_page)
    {
        global $wpdb;

        $dupesql = "SELECT * FROM {$wpdb->prefix}wpcpt_broken_shortcodes "
                 . "WHERE shortcode = %s AND calling_page = %s AND resolved = 0;";
        return $wpdb->get_results(
            $wpdb->prepare(
                $dupesql,
                $shortcode,
                $calling_page
            ),
            ARRAY_A
        );
    }

    /**
     *
     * @global \WPCPT\type $wpdb
     * @param type $shortcode
     * @param type $calling_page
     */
    public static function log($shortcode, $calling_page)
    {
        global $wpdb;

        $insertsql = "INSERT INTO {$wpdb->prefix}wpcpt_broken_shortcodes "
                   . "(shortcode, calling_page) VALUES (%s, %s);";
        $wpdb->query(
            $wpdb->prepare(
                $insertsql,
                $shortcode,
                $calling_page
            )
        );
    }

    /**
     *
     * @param type $name
     * @param type $atts
     * @param type $content
     */
    public static function logBrokenShortcode($name, $atts, $content)
    {
        $shortcode = "[$name";
        foreach ($atts as $k => $v) {
            $shortcode .= " {$k}=\"{$v}\"";
        }
        $shortcode .= ']';
        if (!empty($content)) {
            $shortcode .= $content . "[/{$name}]";
        }

        $calling_page = self::getCallingPage();

        $dupes = self::getDupes($shortcode, $calling_page);
        if (empty($dupes)) {
            $this->log($shortcode, $calling_page);
        }
    }

    /**
     *
     */
    abstract public function run($atts, $content = null);
}
