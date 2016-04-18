<?php

require_once __DIR__.'/../vendor/autoload.php';

$DB = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

class UrlController_getRealUrlTest extends PHPUnit_Framework_TestCase
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
   
    public function testGetRealUrl()
    {   
        $arr['short_url_slug'] = 'tEsT';
        $this->assertEquals('http://php.net/docs.php', $this->urlController->getRealUrl(false, $arr));
    }

} 
