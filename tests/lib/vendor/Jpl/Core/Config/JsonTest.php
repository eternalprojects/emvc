<?php
namespace Test\Jpl\Core\Config;
use \Jpl\Core\Config\Json;

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
    }
    
    
}

