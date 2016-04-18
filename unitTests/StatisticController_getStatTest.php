<?php

require_once __DIR__.'/../vendor/autoload.php';

$DB = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

class StatisticController_getStatTest extends PHPUnit_Framework_TestCase
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

    public function testGetStat()
    {   
        $arr['short_link_id'] = 1;
        $this->assertArraySubset(['short_link_id'=>1], $this->statisticController->getStat(false, $arr));
    }

} 
