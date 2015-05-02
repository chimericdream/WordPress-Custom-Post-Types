<?php
abstract class WPCPT_ShortcodeRegistry
{
    protected $wpcpt_shortcodes = array(
        'wpcpt-raw' => array(
            'class' => 'WPCPT_Shortcode_Raw',
        ),
    );
    protected $shortcodes       = array();
    protected $registry         = array();

    public function __construct()
    {
        $this->registerShortcodes();
    }

    protected function registerShortcodes()
    {
        foreach ($this->shortcodes as $k => $v) {
            $c = $v['class'];
            $this->registry[$k] = new $c();
        }
        foreach ($this->wpcpt_shortcodes as $k => $v) {
            $c = $v['class'];
            $this->registry[$k] = new $c();
        }
    }
}
