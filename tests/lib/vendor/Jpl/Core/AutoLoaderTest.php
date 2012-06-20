<?php

namespace Test\Jpl\Core;
use \Jpl\Core\AutoLoader as AL;

class AutoLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function testFailedAutoLoad ()
    {
        $this->assertFalse(AL::AutoLoad('Model\Tested'));
    }

    public function testModelSuccess ()
    {
        $this->assertTrue(AL::AutoLoad('Model\Test'));
    }

    public function testJplLibSuccess ()
    {
        $this->assertTrue(AL::AutoLoad('Jpl\Core\Router'));
    }

    public function testControllerSuccess ()
    {
        $this->assertTrue(AL::AutoLoad('Controller\Index'));
        $this->assertTrue(AL::AutoLoad('Controller\Error'));
    }
}