<?php
/**
 * 
 */
require_once APPLICATION_PATH . 'lib/Jpl/Router.php';
// ControllerBase contains all of the base functions necessary for
//   each controller class to process page logic as easily as
//   possible
class Jpl_Controller_Front {
    protected $_view;    
    
    protected $_route;
    
    function __construct() {
        $this->_view = new Jpl_View();
        
        $this->_run();
    }
    
    private function _run(){
    	$this->_route = JPL_Router::callControllerAction();
    }
    
    public function __destruct(){
    	$this->_view->render($this->_route);
    	exit;
    }
    
    
}
?>