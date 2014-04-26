<?php
abstract class WPCPT_PostTypeRegistry {
    protected $postTypes = array();
    protected $registry  = array();

    public function __construct() {
        $this->registerPostTypes();
    }

    protected function registerPostTypes() {
        foreach ($this->postTypes as $k => $v) {
            $c = $v['class'];
            $this->registry[$k] = new $c();
        }
    }
}