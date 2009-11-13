<?php

require_once ('lib/Jpl/Registry/Abstract.php');

class Jpl_Registry_Application extends Jpl_Registry_Abstract {
	private static $_instance;
	private $_data = array();
	
	private function __construct() {
	
	}
	
	public static function getInstance(){
		if(!isset(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	}
	
	protected function _set($name, $value) {
		self::getInstance()->_data[$name] = $value;
	}
	
	protected function _get($name) {
		return (isset(self::getInstance()->_data[$name]))?self::getInstance()->_data[$name]:null;
	}
	
	public static function set($name, $value){
		self::getInstance()->_data[$name] = $value;
	}
	
	public static function get($name){
		return (isset(self::getInstance()->_data[$name]))?self::getInstance()->_data[$name]:null;
	}
}

?>