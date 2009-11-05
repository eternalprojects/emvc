<?php
/**
 * The Session Registry class file
 * 
 * @author Jesse Lesperance
 * @copyright 2009 - JPL Web Innovations
 * @filesource
 * @package MVC
 * @version 1.0
 */
/**
 * Include the Abstract Registry parent class file
 * 
 * @link Registry.php
 */
require_once ('Registry.php');
/**
 * Session Registry class for storing and retrieving data into the session superglobal
 * 
 * @author Jesse Lesperance
 * @subpackage Registry
 */
class SessionRegistry extends Registry {
	/**
	 * Holds the instance of the class
	 * 
	 * @var object
	 * @access private
	 * @staticvar
	 */
	private static $_instance;
	/**
	 * The default construct
	 * 
	 * session_start() in thye construct ensures that the session has been initialized so that
	 * we are able to utilize the $_SESSION super-global
	 * 
	 * @access private
	 */
	private function __construct() {
		session_start();
	}
	/**
	 * Create and return an instance of this class
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
	 * Retrieve the requested value from the session registry
	 * 
	 * @see Registry::get()
	 * @access protected
	 * @param string $name
	 * @return mixed
	 */
	protected function get($name) {
		return (isset($_SESSION[__CLASS__][$name]))?$_SESSION[__CLASS__][$name]:null;
	}
	/**
	 * Sets the specified value to the Session
	 * 
	 * @see Registry::set()
	 * @access protected
	 * @param string $name
	 * @param mixed $value
	 */
	protected function set($name, $value) {
		$_SESSION[__CLASS__][$name] = $value;
	}
	/**
	 * Sets an instance of teh Complex class
	 * 
	 * @access public
	 * @static 
	 * @param Complex $complex
	 */
	public static function setComplex(Complex $complex){
		self::getInstance()->set('complex', $complex);
	}
	/**
	 * Retrieves an instance of the Complex class the the Session
	 * 
	 * @access public
	 * @static
	 * @return Complex
	 */
	public static function getComplex(){
		return self::getInstance()->get('complex');
	}
}

?>