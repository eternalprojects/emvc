<?php
namespace Test\Jpl\Core\Controller;
require_once (dirname(__FILE__) . '/../../../../../TestHelper.php');
require_once 'Jpl/Core/Controller/Front.php';
use \Jpl\Core\Controller\Front;

/**
 * Front test case.
 */
class FrontTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Front
     */
    private $Front;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        // TODO Auto-generated FrontTest::setUp()
        
        $this->Front = new Front();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated FrontTest::tearDown()
        $this->Front = null;
        
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
     * Tests Front->run()
     */
    public function testSuccessfulRun ()
    {
        ob_start();
        $this->Front->run();
        $view = ob_get_contents();
        $this->assertStringStartsWith('Index View', $view);
        ob_clean();
    }

    public function testInvalidControllerRun ()
    {
        $_SERVER['REQUEST_URI'] = 'test/index';
        ob_start();
        $this->Front->run();
        $view = ob_get_contents();
        $this->assertRegExp('/.*?(404)/is', $view);
        ob_clean();
       
    }

    public function testInvalidActionRun ()
    {
        $_SERVER['REQUEST_URI'] = 'index/test';
        ob_start();
        $this->Front->run();
        $view = ob_get_contents();
        $this->assertRegExp('/.*?(404)/is', $view);
        ob_clean();
    }
}

