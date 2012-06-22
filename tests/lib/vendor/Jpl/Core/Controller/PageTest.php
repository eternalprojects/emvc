<?php
namespace Test\Jpl\Core\Controller;
use \Jpl\Core\Controller\Page;

/**
 * Page test case.
 */
class PageTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Page
     */
    private $stub;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        $this->stub = $this->getMockForAbstractClass('\Jpl\Core\Controller\Page', array(array('index','index'),new \Jpl\Core\View));
        
   
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated PageTest::tearDown()
        $this->stub = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests Page->__construct()
     */
    public function test__construct ()
    {
        
        $this->stub->expects($this->any())
             ->method('__construct')
             ->will($this->returnValue(array('test','test')));
        
        $this->stub->__construct(array('test','test'));
        
        $route = $this->stub->getRoute();
        $this->assertCount(2, $route);
        $this->assertEquals('test', $route[0]);
        $this->assertEquals('test', $route[1]);
        
    }

    /**
     * Tests Page->setRoute()
     */
    public function testSetRoute ()
    {
        
        $this->stub->setRoute(array('something','crazy'));
        $route = $this->stub->getRoute();
        $this->assertCount(2, $route);
        $this->assertEquals('something', $route[0]);
        $this->assertEquals('crazy', $route[1]);
        
    }

    /**
     * Tests Page->getRoute()
     */
    public function testGetRoute ()
    {
        $route = $this->stub->getRoute();
        $this->assertCount(2, $route);
        $this->assertEquals('index', $route[0]);
        $this->assertEquals('index', $route[1]);
    }

    /**
     * Tests Page->getView()
     */
    public function testGetView ()
    {
        $view = $this->stub->getView();
        $this->assertInstanceOf('\Jpl\Core\View', $view);
    }

    /**
     * Tests Page->__destruct()
     */
    public function test__destructValidRoute ()
    {    
        ob_start();
        $this->stub->__destruct(array('index','index'));
        $data = ob_get_contents();
        var_dump($data);
    }
}

