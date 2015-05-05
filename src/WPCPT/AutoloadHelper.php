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
