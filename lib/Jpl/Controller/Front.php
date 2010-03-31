<?php
/**
 * 
 */

// ControllerBase contains all of the base functions necessary for
//   each controller class to process page logic as easily as
//   possible
class Jpl_Controller_Front {
    protected $_view;    
    protected $_router;
    protected $_route;
    
    function __construct() {
        $this->_view = new Jpl_View();
        $this->_router = new Jpl_Router();
        $this->_run();
    }
    
    private function _run(){
    	try{
    		$this->_route = $this->_router->callControllerAction();
    	}catch(Exception $e){
    		die($e->getMessage());
    	}
    }
    
    public function __destruct(){
    	$this->_view->render($this->_route);
    }
    
    
}
?>