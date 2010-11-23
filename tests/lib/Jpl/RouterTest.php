<?php
require_once 'TestHelper.php';
require_once APPLICATION_PATH . '/lib/Jpl/Router.php';
class Jpl_RouterTest extends PHPUnit_Framework_TestCase
{
    public function testSomething(){
        var_dump(Jpl_Router::callControllerAction());
    }
}
?>