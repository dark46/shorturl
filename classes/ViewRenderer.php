<?php

class ViewRenderer 
{
    function __construct() 
    {
        $this->smarty = SmartySingleton::instance();
    }
    
    function view($templateName, $dataView = false) 
    {
        if ($dataView) {
            $this->smarty->assign($dataView);
        }
        $this->smarty->display($templateName . '.tpl');
        exit();
    }
}
