<?php
// ViewData is the simple data structure used to wrap the data passed from
//   the controller to the view
class Jpl_View  {
    private $vars = array();

    public function __construct() {        
    }

    public function render($view){
    	$folder = strtolower($view[0]);
    	$file = $view[1];
    	include APPLICATION_PATH . "/view/$folder/$file.phtml";
    }
    
	public function __set($key, $val){
		if ('_' != substr($key, 0, 1)) {
            $this->$key = $val;
            return;
        }
	}
	
	public function __get($key)
    {
        if ($this->_strictVars) {
            trigger_error('Key "' . $key . '" does not exist', E_USER_NOTICE);
        }

        return null;
    }
    
}
