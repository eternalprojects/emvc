<?php
require_once (dirname(__FILE__) . '/../../model/Test.php');
class TestTest extends PHPUnit_Framework_TestCase{
    public function testTested(){
        $test = new Test();
	$res = $test->newMethod(); 
        $this->assertEquals('tested',$res);
    }
}
