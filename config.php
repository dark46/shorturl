<?php

define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам

define ('SITE_PATH', realpath(dirname(__FILE__) . DS) . DS); // путь к корневой папке сайта

define ('DOMAIN', $_SERVER['HTTP_HOST']);

define('DB_USER', 'root');

define('DB_PASS', '123');

define('DB_HOST', 'localhost');

define('DB_NAME', 'shorturl');
