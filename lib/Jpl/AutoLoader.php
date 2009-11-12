<?php

class Jpl_AutoLoader {
	
	private function __construct() {
	
	}
	
	public static function AutoLoad($class){
		$parts = explode('_', $class);
		switch ($parts[0]){
			case 'Model':
				array_shift($parts);
				$path = APPLICATION_PATH . '/model/' . implode('/', $parts);
				break;
			default:
				$path = implode('/', $parts);
				break;
		}
		if (@include_once $path .'.php')
			return;
		
	}
}

?>