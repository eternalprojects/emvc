<?php
/**
 * 
 * @author lesperancej
 *
 */
/**
 * 
 * @author lesperancej
 *
 */
class Request {
	/**
	 * 
	 * @var unknown_type
	 */
	private $_properties;
	/**
	 * 
	 * @var unknown_type
	 */
	private $_feedback = array();
	/**
	 * 
	 */
	public function __construct() {
		$this->_init();
		RequestRegistry::setRequest($this);
	}
	/**
	 * 
	 */
	protected function _init(){
		if(isset($_SERVER['REQUET_METHOD'])){
			$this->_properties = $_REQUEST;
			return;
		}
		foreach ($_SERVER['argv'] as $arg){
			list($key, $val) = explode("=", $arg);
			$this->setProperty($key, $val);
		}
	}
	/**
	 * 
	 * @param unknown_type $name
	 */
	public function getProperty($name){
		return (isset($this->_properties[$name]))?$this->_properties[$name]:null;
	}
	/**
	 * 
	 * @param unknown_type $name
	 * @param unknown_type $value
	 */
	public function setProperty($name, $value){
		$this->_properties[$name] = $value;
	}
	/**
	 * 
	 * @param unknown_type $msg
	 */
	public function addFeedback($msg){
		array_push($this->_feedback, $msg);
	}
	/**
	 * 
	 */
	public function getFeedback(){
		return $this->_feedback;
	}
	/**
	 * 
	 * @param unknown_type $sep
	 */
	public function getFeedbackString($sep = "\n"){
		return implode($sep, $this->_feedback);
	}
}

?>