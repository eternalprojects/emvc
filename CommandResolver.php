<?php

class CommandResolver {
	private static $_baseCmd;
	private static $_defaultCmd;
	
	public function __construct() {
		if(!self::$_baseCmd){
			self::$_baseCmd = new ReflectionClass("Command");
			self::$_defaultCmd = new Command_Default();
		}
	}
	
	public function getCommand(Request $request){
		$cmd = $request->getProperty('cmd');
		$sep = DIRECTORY_SEPARATOR;
		if(!cmd)
			return self::$_defaultCmd;
		$cmd = str_replace(array('.', $sep), "", $cmd);
		$filePath = "Command{$sep}{$cmd}.php";
		$className = "Command_$cmd";
		if(file_exists($filePath)){
			@require_once($filePath);
			if(class_exists($className)){
				$cmdClass = new ReflectionClass($className);
				if($cmdClass->isSubclassOf(self::$_baseCmd)){
					return $cmdClass->newInstance();
				}else{
					$request->addFeedback("command '$cmd' not found");
				}
			}
		}
		$request->addFeedback("command '$cmd' not found");
		return clone self::$_defaultCmd;
	}
}

?>