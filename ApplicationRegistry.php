<?php
/**
 * The Application Regtistry Class File
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
require_once ('Registry.php');
/**
 * This class uses serialization to store and retrieve properties on the application level
 * 
 * @author Jesse Lesperance
 * @subpackage Registry
 */
class ApplicationRegistry extends Registry {
	/**
	 * An instance of this class
	 * 
	 * @var $_instance object
	 * @access private
	 * @staticvar
	 */
	private static $_instance;
	/**
	 * The dir where the values are to be saved
	 * 
	 * @access private
	 * @var $_freezeDir string
	 */
	private $_freezeDir = "data";
	/**
	 * The stored values
	 * 
	 * @access private
	 * @var array
	 */
	private $_values = array();
	/**
	 * @access private
	 * @var $_mtimes array
	 */
	private $_mtimes = array();
	/**
	 * The default construct method
	 */
	function __construct() {

	}
	/**
	 * Creates and returns a single uinstance of this class
	 * 
	 * @access public
	 * @static
	 * @return ApplicationRegistry
	 */
	public static function getInstance(){
		if(!isset(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	} 
	
	/**
	 * Retrieve the property and unserialize it
	 * 
	 * This function retrieves the specified property value from a file store, unserializes it and returns it
	 * 
	 * @access protected
	 * @param string $name
	 * @return mixed
	 * @see Registry::get()
	 */
	protected function get($name) {
		$path = $this->_freezeDir . DIRECTORY_SEPARATOR . $name;
		if(file_exists($path)){
			clearstatcache($path);
			$mtime = filemtime($path);
			if(!isset($this->_mtimes[$name]))
				$this->_mtimes[$name] = 0;
			if($mtime > $this->_mtimes[$name]){
				$data = file_get_contents($path);
				$this->_mtimes[$name] = $mtime;
				return ($this->_values[$name] = unserialize($data));
			}
		}
		return (isset($this->_values[$name]))?$this->_values[$name]:null;		
	}

	/**
	 * Serializes and stores the specified property value
	 * 
	 * @access protected
	 * @param string $name
	 * @param string $value
	 * @see Registry::set()
	 */
	protected function set($name, $value) {
		$this->_values[$name] = $value;
		$path = $this->_freezeDir . DIRECTORY_SEPARATOR . $name;
		file_put_contents($path, serialize($value));
		$this->_mtimes[$name] = time();
	}
	/**
	 * public gateway function for storing the dsn
	 * 
	 * @access public
	 * @static
	 * @param mixed $dsn
	 * @return boolean
	 */
	public static function setDSN($dsn){
		return self::getInstance()->set('dsn', $dsn);
	}
	/**
	 * Retrieve the stored DSN value
	 * 
	 * @access public
	 * @static
	 * @return mixed
	 */
	public static function getDSN(){
		return self::getInstance()->get($dsn);
	}
}

?>