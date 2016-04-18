<?php

require_once __DIR__.'/../vendor/autoload.php';

$DB = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

class UrlController_createShortUrlTest extends PHPUnit_Framework_TestCase
{
    private $index;
 
    protected function setUp()
    {
        $this->urlController = new UrlController();
    }
 
    protected function tearDown()
    {
        $this->urlController = NULL;
    }
 
    public function testCreateShortUrl()
    {   
        $arr['url'] = 'http://test.com/test/';
        $this->assertArraySubset(['success'=>true], $this->urlController->createShortUrl($arr, false));
    }


} 
