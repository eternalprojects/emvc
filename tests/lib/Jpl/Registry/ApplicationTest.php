<?php
namespace Test\Jpl\Registry;
require_once 'Library\Jpl\Registry\Application.php';
use \Jpl\Registry\Application;
require_once 'PHPUnit\Framework\TestCase.php';

/**
 * Application test case.
 */
class ApplicationTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Application
     */
   

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        // TODO Auto-generated ApplicationTest::setUp()
        
        
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated ApplicationTest::tearDown()
       
        
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
     * Tests Application::set()
     */
    public function testSet ()
    {
        Application::set('test','string');
        $this->assertEquals('string', Application::get('test'));
    }

    /**
     * Tests Application::get()
     */
    public function testGet ()
    {
        Application::set('test2', 'string2');
        $this->assertEquals('string2', Application::get('test2'));
    }
    
}

