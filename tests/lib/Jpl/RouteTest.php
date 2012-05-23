<?php
require_once (dirname(__FILE__) . '/../../TestHelper.php');
require_once(APPLICATION_PATH . '/Library/Jpl/Route.php');
class Jpl_RouteTest extends PHPUnit_Framework_TestCase
{
    protected $route;
    
    public function setUp(){
        $this->route = new Jpl_Route('/test/test', 'test', 'test');    
    }
    
    public function testGetMappedUrl(){
        $this->assertEquals('/test/test', $this->route->getUrl());
    }
    
    public function testGetControllerName(){
        $this->assertEquals('Test', $this->route->getControllerName());
    }
    
    public function testGetActionName(){
        $this->assertEquals('test', $this->route->getActionName());
    }
    
    public function testIsMatch(){
        $this->assertTrue($this->route->isMatch('/test/test'));
    }
    
    public function testIsNotMatch(){
        $this->assertFalse($this->route->isMatch('/test/something'));
    }
    
    public function tearDown(){
        $this->route = null;
    }
    
}
?>