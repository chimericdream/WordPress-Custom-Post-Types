<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * LICENSE: Some license information
 *
 * @package    Zend_Magic
 * @subpackage Wand
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.5.0
 */
namespace WPCPT\Shortcode;

use \WPCPT\Shortcode;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Zend_Magic
 * @subpackage Wand
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
class Raw extends Shortcode
{
    /**
     *
     */
    public function __construct()
    {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_content', 'wptexturize');
        add_filter('the_content', array($this, 'filter'), 99);
    }

    /**
     *
     * @param type $content
     * @return type
     */
    public function filter($content)
    {
        $plaintext_shortcodes = array(
            '\[raw\].*?\[\/raw\]',
        );

        $new_content      = '';
        $pattern_full     = '/(' . implode('|', $plaintext_shortcodes) . ')/is';
        $pattern_contents = '/\[raw\](.*?)\[\/raw\]/is';
        $pieces           = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($pieces as $piece) {
            $matches = array();
            if (preg_match($pattern_contents, $piece, $matches)) {
                $new_content .= $matches[2];
            } else {
                $new_content .= wptexturize(wpautop($piece));
            }
        }

        return $new_content;
    }

    /**
     *
     * @param type $atts
     * @param type $content
     * @return string
     */
    public function run($atts, $content = null)
    {
        return '';
    }
}
