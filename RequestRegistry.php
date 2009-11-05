<?php
/**
 *
 */
require_once ('Registry.php');
/**
 *
 * @author Jesse
 *
 */
class RequestRegistry extends Registry {
	/**
	 *
	 */
	private $_values = array();
	/**
	 *
	 * @var unknown_type
	 */
	private static $_instance;
	/**
	 *
	 */
	private function __construct() {

	}
	/**
	 *
	 */
	public static function getInstance(){
		if(!isset(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	}
	/**
	 *
	 * @param unknown_type $name
	 */
	protected function get($name) {
		return (isset($this->_values[$name]))?$this->_values[$name]:null;
	}
	/**
	 *
	 * @param unknown_type $name
	 * @param unknown_type $value
	 */
	protected function set($name, $value) {
		$this->_values[$name] = $value;
	}
	/**
	 *
	 * @param unknown_type $name
	 */
	static function getRequest($name){
		return self::getInstance()->get('request');
	}
	/**
	 *
	 * @param Request $request
	 */
	static function setRequest(Request $request){
		return self::getInstance()->set('request', $request);
	}
}

?>