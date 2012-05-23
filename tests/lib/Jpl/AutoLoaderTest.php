<?php

namespace Test\Jpl;
require_once (dirname(__FILE__) . '/../../TestHelper.php');
require_once (APPLICATION_PATH . '/Library/Jpl/AutoLoader.php');
use Jpl\AutoLoader as AL;

class Jpl_AutoLoaderTest extends PHPUnit_Framework_TestCase
{
    public function testFailedAutoLoad ()
    {
        $this->assertFalse(AL::AutoLoad('Model_Tested'));
    }
    public function testSuccessfulAutoLoad ()
    {
        $this->assertTrue(AL::AutoLoad('Model_Test'));
    }
    public function testJplAutoLoad(){
        $this->assertTrue(AL::AutoLoad('Jpl_Route'));
    }
}
?>
