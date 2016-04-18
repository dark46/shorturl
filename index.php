<?php

error_reporting (E_ALL); 

require_once __DIR__.'/vendor/autoload.php';

$DB = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

$router = new Router();

$router->run();
