<?php

class Request {
	private $_properties;
	private $_feedback = array();
	
	public function __construct() {
		$this->init();
		RequestRegistry::serRequest($this);
	}
	
	
}

?>