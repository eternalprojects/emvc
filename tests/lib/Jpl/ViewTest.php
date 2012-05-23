<?php
require_once (dirname(__FILE__) . '/../../TestHelper.php');
require_once (APPLICATION_PATH . '/Library/Jpl/View.php');
/**
 * test case.
 */
class Jpl_ViewTest extends PHPUnit_Framework_TestCase
{
    private $view;
    public function setup(){
        $this->view = new Jpl_View();
    }
    
    public function testRenderAction(){
        $this->view->title = "Test Index View";
        $data = array('index','index');
        ob_start();
        $this->view->render($data);
        $view = ob_get_contents();
        ob_end_clean();
        $this->assertStringStartsWith('Test Index View', $view);
    }
    
    public function testSetterGetter(){
        $this->view->name = "Jesse";
        $this->assertEquals("Jesse", $this->view->name);
    }
}

