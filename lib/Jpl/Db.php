<?php

class Jpl_Db {
	
	private $_db = null;
	private static $_instance;
	
	private function __construct($p){
		$this->_db = new PDO('mysql:host='.$p['host'].';dbname='.$p['dbname'], $p['username'], $p['password']);
	}
	
	public static function init($params){
		if(self::$_instance == null){
			self::$_instance = new self($params);
		}
		return self::$_instance;
	}
	
	public function select($columns = null){
		require_once 'Jpl/Db/Select.php';
		$select = new Jpl_Db_Select($columns);
		return $select;
	}
	
	public function fetchAll(Jpl_Db_Select $select){
		$result = $this->_db->fetchAll(PDO_FETCH_MODE::ASSOC);
		return $result;
	}
	
	private function generateQuery(Jpl_Db_Select $select){
		
	}
}

?>