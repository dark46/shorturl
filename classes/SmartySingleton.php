<?php

class SmartySingleton
{
    static private $instance;    
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
    
    static public function instance()
    {
        if (!isset(self::$instance)) {
            $smarty = new Smarty;
            $smarty->setTemplateDir(array(
                SITE_PATH . 'views/templates/',
            )); 
            $smarty->setCompileDir(SITE_PATH . 'views/templates_c/');
            $smarty->debugging = false;
            self::$instance = $smarty;
        }
        return self::$instance;
    }
}
