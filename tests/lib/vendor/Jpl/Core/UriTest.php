<?php
namespace Test\Jpl\Core;
use \Jpl\Core\Uri;

/**
 * Uri test case.
 */
class UriTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Uri
     */
    private $Uri;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        Uri::resetInstance();
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        
    }

    public function testGetInstance ()
    {
        $_GET['route'] = 'test/testing/id/3';
        $uri = Uri::getInstance();
        $this->assertInstanceOf('\Jpl\Core\Uri', $uri);
        $params = Uri::getParams();
        $this->assertEquals(3, (int) $params['id']);
    }

    /**
     * Tests Uri::getController()
     */
    public function testGetController ()
    {
        $_GET['route'] = 'test/testing/get/controller';
        $this->assertEquals('test', Uri::getController());
    }

    /**
     * Tests Uri::setController()
     */
    public function testSetController ()
    {
        $_GET['route'] = 'test/testing/set/controller';
        $this->assertEquals('test', Uri::getController());
        $this->assertTrue(Uri::setController('something'));
        $this->assertEquals('something', Uri::getController());
    }

    /**
     * Tests Uri::setAction()
     */
    public function testSetAction ()
    {
        $_GET['route'] = 'test/testing/set/action';
        $this->assertTrue(Uri::setAction('guess'));
        $this->assertEquals('guess', Uri::getAction());
    }

    /**
     * Tests Uri::getAction()
     */
    public function testGetAction ()
    {
        $_GET['route'] = 'test/testing/get/action';
        $this->assertTrue(Uri::setAction('everything'));
        $this->assertEquals('everything', Uri::getAction());
    }

    /**
     * Tests Uri::getParam()
     */
    public function testGetParam ()
    {
        $_GET['route'] = 'test/testing/get/param';
        $this->assertEquals('test', Uri::getParam(0));
        $this->assertEquals('testing', Uri::getParam(1));
        $this->assertEquals('tested', Uri::getParam(2));
    }

    /**
     * Tests Uri::getParams()
     */
    public function testGetParams ()
    {
        $_GET['route'] = 'test/testing/get/params';
        $params = Uri::getParams();
        $this->assertCount(1, $params);
        $this->assertEquals('test', $params[0]);
        $this->assertEquals('testing', $params[1]);
        $this->assertEquals('tested', $params[2]);
    }

    /**
     * Tests Uri::setParam()
     */
    public function testSetParamNoKey ()
    {
        $_GET['route'] = 'test/testing/set/params/no/key';
        $this->assertTrue(Uri::setParam('some data'));
        $this->assertNotEmpty(Uri::getParam(3));
        $this->assertEquals('some data', Uri::getParam(3));
    }
    
}

