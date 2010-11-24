<?php
require_once 'TestHelper.php';
require_once APPLICATION_PATH . '/lib/Jpl/Router.php';
require_once(APPLICATION_PATH . '/lib/Jpl/Exception/InvalidAction.php');
require_once(APPLICATION_PATH . '/lib/Jpl/Exception/InvalidController.php');

class Jpl_RouterTest extends PHPUnit_Framework_TestCase
{
    public function testCallControllerNoURL(){
        ob_start();
        Jpl_Router::callControllerAction();
        $view = ob_get_contents();
        ob_end_clean();
        $this->assertStringStartsWith('Index View', $view);
    }
    
    public function testCallControllerWithIndex(){
        $_GET['route'] = 'index/index';
        ob_start();
        Jpl_Router::callControllerAction();
        $view = ob_get_contents();
        ob_end_clean();
        $this->assertStringStartsWith('Index View', $view);
    }
    
    public function testCallControllerWithAssert(){
        $_GET['route'] = 'index/assert';
        ob_start();
        Jpl_Router::callControllerAction();
        $view = ob_get_contents();
        ob_end_clean();
        $this->assertStringStartsWith('Assert View', $view);
    }
    
    public function testCallControllerWithInvalidAction(){
        $_GET['route'] = 'index/test';
        try{
            Jpl_Router::callControllerAction();
        }catch(Jpl_Exception_InvalidAction $e){
            $this->assertEquals("testActionDoes not exist in IndexController", $e->getMessage());
        }
        
    }
    
    public function testCallControllerWithInvalidController(){
        $_GET['route'] = 'test/assert';
        try{
            Jpl_Router::callControllerAction();
        }catch(Jpl_Exception_InvalidController $e){
            $this->assertEquals("TestControllerDoes not exist.", $e->getMessage());
        }
    }
}
?>