<?php
require_once (dirname(__FILE__) . '/../../TestHelper.php');
require_once (APPLICATION_PATH . '/lib/Jpl/View.php');
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
        $data = array('index','index');
        $this->view->render($view);
    }
}

