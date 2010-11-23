<?php

require_once('../../TestHelper.php');
require_once('../../../lib/Jpl/AutoLoader.php');

class AutoLoaderTest extends PHPUnit_Framework_TestCase {
	public function testFailedAutoLoad(){
		$this->assertFalse(Jpl_AutoLoader::AutoLoad('Model_Test'));
	}
}

?>