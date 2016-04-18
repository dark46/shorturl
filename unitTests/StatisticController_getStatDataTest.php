<?php

require_once __DIR__.'/../vendor/autoload.php';

$DB = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

class StatisticController_getStatDataTest extends PHPUnit_Framework_TestCase
{
    private $index;
 
    protected function setUp()
    {
        $this->statisticController = new StatisticController();
    }
 
    protected function tearDown()
    {
        $this->statisticController = NULL;
    }

    public function testGetStatData()
    {   
        $arr['url_id'] = 1;
        $this->assertArraySubset(['success'=>true], $this->statisticController->getStatData($arr, false));
    }

} 
