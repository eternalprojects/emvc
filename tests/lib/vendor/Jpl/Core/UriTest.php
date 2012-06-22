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
        $_SERVER['QUERY_STRING'] = 'index/test/id/3';
        $uri = Uri::getInstance();
        $this->assertInstanceOf('\Jpl\Core\Uri', $uri);
        $params = Uri::getParams();
        $this->assertEquals('id', $params[2]);
        $this->assertEquals('index', $params[0]);
        $this->assertEquals('test', $params[1]);
        $this->assertEquals(3, (int) $params[3]);
    }

    /**
     * Tests Uri::getController()
     */
    public function testGetController ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $this->assertTrue(Uri::setController('testing'));
        $this->assertEquals('testing', Uri::getController());
    }

    /**
     * Tests Uri::setController()
     */
    public function testSetController ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $this->assertTrue(Uri::setController('something'));
        $this->assertEquals('something', Uri::getController());
    }

    /**
     * Tests Uri::setAction()
     */
    public function testSetAction ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $this->assertTrue(Uri::setAction('guess'));
        $this->assertEquals('guess', Uri::getAction());
    }

    /**
     * Tests Uri::getAction()
     */
    public function testGetAction ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $this->assertTrue(Uri::setAction('everything'));
        $this->assertEquals('everything', Uri::getAction());
    }

    /**
     * Tests Uri::getParam()
     */
    public function testGetParam ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $this->assertEquals('test', Uri::getParam(0));
        $this->assertEquals('testing', Uri::getParam(1));
        $this->assertEquals('tested', Uri::getParam(2));
    }

    /**
     * Tests Uri::getParams()
     */
    public function testGetParams ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $params = Uri::getParams();
        $this->assertCount(3, $params);
        $this->assertEquals('test', $params[0]);
        $this->assertEquals('testing', $params[1]);
        $this->assertEquals('tested', $params[2]);
    }

    /**
     * Tests Uri::setParam()
     */
    public function testSetParamNoKey ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $this->assertTrue(Uri::setParam('some data'));
        $this->assertNotEmpty(Uri::getParam(3));
        $this->assertEquals('some data', Uri::getParam(3));
    }

    public function testClonability ()
    {
        $_SERVER['QUERY_STRING'] = 'test/testing/tested';
        $u = Uri::getInstance();
        $u2 = new \ReflectionClass('\Jpl\Core\Uri');
        $this->assertTrue($u2->getMethod('__clone')->isPrivate());
    }
    
}

