<?php
require_once (dirname(__FILE__) . '/../../../TestHelper.php');
require_once (APPLICATION_PATH . '/lib/Jpl/AutoLoader.php');
class Jpl_AutoLoaderTest extends PHPUnit_Framework_TestCase
{
    public function testFailedAutoLoad ()
    {
        $this->assertFalse(Jpl_AutoLoader::AutoLoad('Model_Tested'));
    }
    public function testSuccessfulAutoLoad ()
    {
        $this->assertTrue(Jpl_AutoLoader::AutoLoad('Model_Test'));
    }
    public function testJplAutoLoad(){
        $this->assertTrue(Jpl_AutoLoader::AutoLoad('Jpl_Route'));
    }
}
?>
