<?php
/**
 * 
 * @author jlswebdev
 *
 */
/**
 *
 * @author jlswebdev
 *        
 */
namespace Test\Jpl;
require_once (dirname(__FILE__) . '/../../TestHelper.php');
require_once (APPLICATION_PATH . '/Library/Jpl/AutoLoader.php');
use Jpl\AutoLoader as AL;

/**
 *
 * @author jlswebdev
 *        
 */
class AutoLoaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     */
    public function testFailedAutoLoad ()
    {
        $this->assertFalse(AL::AutoLoad('\Model\Tested'));
    }

    /**
     */
    public function testSuccessfulAutoLoad ()
    {
        $this->assertTrue(AL::AutoLoad('\Model\Test'));
    }

    /**
     */
    public function testJplAutoLoad ()
    {
        $this->assertTrue(AL::AutoLoad('\Jpl\Route'));
    }
}
?>
