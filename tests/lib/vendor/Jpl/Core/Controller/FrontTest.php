<?php
namespace Test\Jpl\Core\Controller;
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
        $view = ob_get_flush();
        $this->assertStringStartsWith('Index View', $view);
    }

    public function testInvalidControllerRun ()
    {
        $_GET['route'] = 'test/index';
        try {
            $this->Front->run();
        } catch (\Jpl\Core\Exception\InvalidController $e) {
            $this->assertEquals('\Controller\Test: Does not exist.', 
                    $e->getMessage());
        }
    }

    public function testInvalidActionRun ()
    {
        $_GET['route'] = 'index/test';
        try {
            $this->Front->run();
        } catch (\Jpl\Core\Exception\InvalidAction $e) {
            $this->assertEquals(
                    'testAction: Does not exist in \Controler\Index');
        }
    }
}

