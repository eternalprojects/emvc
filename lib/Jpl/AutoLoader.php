<?php

class Jpl_AutoLoader {
	
	private function __construct() {
	
	}
	
	public static function AutoLoad($class){
		$path = str_ireplace("_", "/", $class);
		if (@include_once $path .'.php')
			return;
	}
}

?>