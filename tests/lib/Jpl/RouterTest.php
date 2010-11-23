<?php
require_once 'TestHelper.php';
require_once APPLICATION_PATH . '/lib/Jpl/Router.php';

class Jpl_RouterTest extends PHPUnit_Framework_TestCase
{
    public function testCallControllerNoURL(){
        $view = Jpl_Router::callControllerAction();
        $this->assertStringStartsWith('Index View', $view);
    }
}
?>