<?php
/**
 * Short description for file
 *
 * @package    WPCPT\PostType\Field
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
 * @package    WPCPT\PostType\Field
 * @author     Bill Parrott <bill@chimericdream.com> (http://chimericdream.com/)
 * @copyright  2014-15 Bill Parrott
 * @license    http://opensource.org/licenses/MIT
 * @link       http://framework.zend.com/package/PackageName
 * @since      Class available since Release 1.0.0
 */
abstract class Field
{
    /**
     *
     * @var type
     */
    protected $fieldId    = '';

    /**
     *
     * @var type
     */
    protected $fieldName  = null;

    /**
     *
     * @var type
     */
    protected $labelText  = '&nbsp;';

    /**
     *
     * @var type
     */
    protected $value      = '';

    /**
     *
     * @var type
     */
    protected $attributes = array();

    /**
     *
     * @var type
     */
    protected $options    = array();

    /**
     *
     * @var type
     */
    protected $note       = '';

    /**
     *
     */
    public function render()
    {
        echo '<tr valign="top">';
        $this->showLabel();
        echo '<td>';
        $this->renderField();
        echo '</td></tr>';
    }

    /**
     *
     */
    public function renderField()
    {
        echo '';
    }

    /**
     *
     * @return type
     */
    public function getNameAttribute()
    {
        if (empty($this->fieldName)) {
            return $this->fieldId;
        } else {
            return $this->fieldName;
        }
    }

    /**
     *
     * @param type $value
     */
    public function __construct($value = '')
    {
        $this->value = $value;
    }

    /**
     *
     * @param type $id
     * @return \WPCPT\Field
     */
    public function setId($id)
    {
        $this->fieldId = $id;
        return $this;
    }

    /**
     *
     * @param type $name
     * @return \WPCPT\Field
     */
    public function setName($name)
    {
        $this->fieldName = $name;
        return $this;
    }

    /**
     *
     * @param type $label
     * @return \WPCPT\Field
     */
    public function setLabel($label)
    {
        $this->labelText = $label;
        return $this;
    }

    /**
     *
     * @param type $value
     * @return \WPCPT\Field
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     *
     * @param type $atts
     * @return \WPCPT\Field
     */
    public function setAttributes($atts)
    {
        $this->attributes = $atts;
        return $this;
    }

    /**
     *
     * @param type $opts
     * @return \WPCPT\Field
     */
    public function setOptions($opts)
    {
        $this->options = $opts;
        return $this;
    }

    /**
     *
     * @param type $note
     * @return \WPCPT\Field
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     *
     */
    protected function showLabel()
    {
        echo '<th scope="row"><label for="' . $this->fieldId . '">' . $this->labelText . '</label></th>';
    }

    /**
     *
     */
    protected function renderAttributes()
    {
        foreach ($this->attributes as $att => $val) {
            echo ' ' . $att . '="' . $val . '"';
        }
    }
}
