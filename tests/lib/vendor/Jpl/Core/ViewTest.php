<?php
namespace Test\Jpl\Core;
require_once ('Jpl/Core/View.php');
use Jpl\Core\View;

/**
 * test case.
 */
class ViewTest extends \PHPUnit_Framework_TestCase
{

    private $view;

    public function setup ()
    {
        $this->view = new View();
    }

    public function testRenderAction ()
    {
        $this->view->title = "Test Index View";
        $data = array(
                'index',
                'index'
        );
        ob_start();
        $this->view->render($data);
        $view = ob_get_contents();
        ob_end_clean();
        $this->assertStringStartsWith('Test Index View', $view);
    }

    public function testSetterGetter ()
    {
        $this->view->name = "Jesse";
        $this->assertEquals("Jesse", $this->view->name);
    }
}

