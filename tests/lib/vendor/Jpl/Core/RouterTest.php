<?php
namespace Test\Jpl\Core;
require_once (dirname(__FILE__) . '/../../../../TestHelper.php');
require_once 'Jpl/Core/Router.php';
require_once 'Jpl/Core/Exception.php';
require_once ('Jpl/Core/Exception/InvalidAction.php');
require_once ('Jpl/Core/Exception/InvalidController.php');

use \Jpl\Core\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{

    public function testCallControllerNoURL ()
    {
        ob_start();
        Router::callControllerAction();
        $view = ob_get_contents();
        
        $this->assertStringStartsWith('Index View', $view);
    }

    public function testCallControllerWithIndex ()
    {
        $_SERVER['REQUEST_URI'] = 'index/index';
        ob_start();
        Router::callControllerAction();
        $view = ob_get_contents();
        $this->assertStringStartsWith('Index View', $view);
    }

    public function testCallControllerWithAssert ()
    {
        $_SERVER['REQUEST_URI'] = 'index/assert';
        ob_start();
        Router::callControllerAction();
        $view = ob_get_contents();
        ob_end_clean();
        $this->assertStringStartsWith('Assert View', $view);
    }

    public function testCallControllerWithInvalidAction ()
    {
        $_SERVER['REQUEST_URI'] = 'index/test';
        try {
            Router::callControllerAction();
        } catch (\Jpl\Core\Exception\InvalidAction $e) {
            $this->assertEquals(
                    "testAction: Does not exist in \Controller\Index", 
                    $e->getMessage());
        }
    }

    public function testCallControllerWithInvalidController ()
    {
        $_SERVER['REQUEST_URI'] = 'test/assert';
        try {
            Router::callControllerAction();
        } catch (\Jpl\Core\Exception\InvalidController $e) {
            $this->assertEquals("\Controller\Test: Does not exist.", 
                    $e->getMessage());
        }
    }

    public function testRegisterRoute ()
    {
        $route = new \Jpl\Core\Route('/test/assert', 'test', 'test');
        Router::registerRoute($route);
        $_SERVER['REQUEST_URI'] = '/test/assert';
        try {
            Router::callControllerAction();
        } catch (\Jpl\Core\Exception\InvalidController $e) {
            $this->assertEquals("\Controller\Test: Does not exist.", 
                    $e->getMessage());
        }
    }

    public function testRegisterRouteFail ()
    {
        $route = new \Jpl\Core\Route('test/assert', 'test', 'test');
        Router::registerRoute($route);
        $_SERVER['REQUEST_URI'] = '/test/assert';
        try {
            Router::callControllerAction();
        } catch (\Jpl\Core\Exception\InvalidController $e) {
            $this->assertEquals("\Controller\Test: Does not exist.", 
                    $e->getMessage());
        }
    }
}
?>
