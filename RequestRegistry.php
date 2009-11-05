<?php
/**
 * The Request Registry Class file
 *
 * @author Jesse Lesperance
 * @copyright 2009 - JPL Web Innovations
 * @filesource
 * @package MVC
 * @version 1.0
 */
/**
 * Include the Registry Abstract Class
 *
 * @link Registry.php
 */
include 'Registry.php';
/**
 * The Request Registry Class for storing and retrieving the request object
 *
 * @author Jesse Lesperance
 * @subpackage Registry
 */
class RequestRegistry extends Registry {
	/**
	 * An array that holds the registry object
	 *
	 * @access private
	 * @var array
	 */
	private $_values = array();
	/**
	 * The instance of the class
	 *
	 * @var object
	 * @access private
	 * @staticvar
	 */
	private static $_instance;
	/**
	 * The constructor
	 *
	 * @access private
	 */
	private function __construct() {

	}
	/**
	 * Static function to get an instance of the class
	 *
	 * @access public
	 * @static
	 * @return object
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