<?php

class MainController    
{
    protected    $viewRenderer;

    function __construct() 
    {
        $this->viewRenderer = new ViewRenderer();
    }
}
