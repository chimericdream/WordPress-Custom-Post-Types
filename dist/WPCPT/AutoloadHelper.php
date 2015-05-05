<?php
/**
 * Short description for file
 *
 * @package    WPCPT\Autoloader
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
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
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class AutoloadHelper
{
    /**
     *
     * @var type
     */
    protected $directories = array();

    /**
     *
     * @param type $dir
     */
    public function addDirectory($dir)
    {
        $this->directories[] = $dir;
    }

    /**
     *
     * @return type
     */
    public function getDirectories()
    {
        return $this->directories;
    }
}
