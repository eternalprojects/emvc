<?php
namespace Test\Jpl\Core\Config;

use \Jpl\Core\Config\Exception;

/**
 * Exception test case.
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Exception
     */
    private $Exception;

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
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        
    }

    public function testConfigException ()
    {
        try {
            throw new Exception();
        } catch (\Jpl\Core\Config\Exception $e) {
            $this->assertInstanceOf('\Jpl\Core\Config\Exception', $e);
            $this->assertInstanceOf('\Jpl\Core\Exception', $e);
            $this->assertInstanceOf('\Exception', $e);
            $this->assertEquals('', $e->getMessage());
            $this->assertEquals(0, $e->getCode());
        }
    }

    public function testConfigExceptionWithMessage ()
    {
        try {
            throw new Exception("I hate Any build scripts!");
        } catch (\Jpl\Core\Config\Exception $e) {
            $this->assertInstanceOf('\Jpl\Core\Config\Exception', $e);
            $this->assertInstanceOf('\Jpl\Core\Exception', $e);
            $this->assertInstanceOf('\Exception', $e);
            $this->assertEquals('I hate Any build scripts!', $e->getMessage());
            $this->assertEquals(0, $e->getCode());
        }
    }

    public function testConfigExceptionWithMessageAndCode ()
    {
        try {
            throw new Exception("I hate Any build scripts!", 21);
        } catch (\Jpl\Core\Config\Exception $e) {
            $this->assertInstanceOf('\Jpl\Core\Config\Exception', $e);
            $this->assertInstanceOf('\Jpl\Core\Exception', $e);
            $this->assertInstanceOf('\Exception', $e);
            $this->assertEquals('I hate Any build scripts!', $e->getMessage());
            $this->assertEquals(21, $e->getCode());
        }
    }
}

