<?php
namespace Test\Jpl\Core\Config;
require_once(dirname(__FILE__).'/_files/Test.php');
use \Jpl\Core\Config\Json;
use \Test\Jpl\Core\Config\Data\Test;

/**
 * Json test case.
 */
class JsonTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var Json
     */
    private $Json;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        
        
        
        $this->Json = new Json(dirname(__FILE__).'/_files/test.json');
        
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
       
        $this->Json = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        
    }

    /**
     * Tests Json->__construct()
     */
    public function test__construct ()
    {
        $s = $this->Json->__construct(dirname(__FILE__).'/_files/test.json');
        $this->assertInstanceOf('\stdClass', $s);
        $this->assertEquals('file', $s->menu->id);
        $this->AssertEquals('New', $s->menu->popup->menuitem[0]->value);
        
    }
    
    public function testToObjectWithString()
    {
        $ts = $this->getStub('\Jpl\Core\Config\Json', '_toObject');
        $res = $ts->invoke(new \Jpl\Core\Config\Json(dirname(__FILE__).'/_files/test.json'), 'test');
        $this->assertStringStartsWith('test', $res);
        
    }
    
    public function testToObjectWithObject()
    {
        $obj = new Test();
        $ts = $this->getStub('\Jpl\Core\Config\Json', '_toObject');
        $res = $ts->invoke(new \Jpl\Core\Config\Json(dirname(__FILE__).'/_files/test.json'), $obj);
        $this->assertInstanceOf('\Test\Jpl\Core\Config\Data\Test', $res);
    }
    
    public function testToObjectWithArray()
    {
        $arr = array('something'=>'else', 'what'=>'indeed');
        $ts = $this->getStub('\Jpl\Core\Config\Json', '_toObject');
        $res = $ts->invoke(new \Jpl\Core\Config\Json(dirname(__FILE__).'/_files/test.json'), $arr);
        $this->assertInstanceOf('\stdClass', $res);
        $this->assertEquals('else', $res->something);
        $this->assertEquals('indeed', $res->what);
    }
    
    private function getStub($class, $method){
        $json = new \ReflectionClass($class);
        $ts = $json->getMethod($method);
        $this->assertTrue($ts->isProtected());
        $ts->setAccessible(true);
        return $ts;
    }
    
    public function testToObjectWithEmptyArray(){
        $ts = $this->getStub('\Jpl\Core\Config\Json', '_toObject');
        $this->assertFalse($ts->invoke(new \Jpl\Core\Config\Json(dirname(__FILE__).'/_files/test.json'), array()));
    }
    
}

