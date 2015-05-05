<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field\Textarea
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @version    2.0.0a
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.0.0
 */
namespace WPCPT\Field\Textarea;

use \WPCPT\Field\Textarea;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    WPCPT\PostType\Field\Textarea
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class NoWysiwyg extends Textarea
{
    /**
     *
     */
    public function renderField()
    {
        echo '<div class="plain-textarea-wrap">';
        if (!empty($this->note)) {
            echo "<p><strong>Note:</strong> {$this->note}</p>";
        }
        echo '<textarea id="' . $this->fieldId . '" name="' . $this->getNameAttribute() . '"';
        $this->renderAttributes();
        echo ">{$this->value}</textarea></div>";
    }
}
