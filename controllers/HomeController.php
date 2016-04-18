<?php

class HomeController extends MainController 
{
    public function __construct() {
        parent::__construct();
    }

    public function index($request = false, $args) {    
        $this->viewRenderer->view('index');    
    }    
}
