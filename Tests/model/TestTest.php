<?php
require_once (dirname(__FILE__) . '/../../Model/Test.php');
class TestTest extends PHPUnit_Framework_TestCase{
    public function testTested(){
        $test = new Test();
	$res = $test->newMethod(); 
        $this->assertEquals('Tested',$res);
    }
}
