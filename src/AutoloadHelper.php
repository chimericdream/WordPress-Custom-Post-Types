<?php
namespace WPCPT;

class AutoloadHelper
{
    protected $directories = array();

    public function addDirectory($dir)
    {
        $this->directories[] = $dir;
    }

    public function getDirectories()
    {
        return $this->directories;
    }
}