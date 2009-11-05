<?php

require_once ('Registry.php');

class SessionRegistry extends Registry {
	/**
	 *
	 * @var unknown_type
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
		session_start();
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
	 * @see Registry::get()
	 */
	protected function get($name) {
		return (isset($_SESSION[__CLASS__][$name]))?$_SESSION[__CLASS__][$name]:null;
	}

	/**
	 *
	 * @see Registry::set()
	 */
	protected function set($name, $value) {
		$_SESSION[__CLASS__][$name] = $value;
	}

	public static function setComplex(Complex $complex){
		self::getInstance()->set('complex', $complex);
	}

	public static function getComplex(){
		return self::getInstance()->get('complex');
	}
}

?>