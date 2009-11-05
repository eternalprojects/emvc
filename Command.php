<?php

abstract class Command {
	
	final function __construct() {
		
	}
	
	public function execute(Request $request){
		$this->doExecute($request);
	}
	
	abstract function doExecute(Request $request){
		
	}
}

?>