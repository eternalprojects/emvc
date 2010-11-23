<?php
require_once 'TestHelper.php';
require_once APPLICATION_PATH . '/lib/Jpl/Router.php';

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
}
?>