<?php
/**
 * 
 */
require_once APPLICATION_PATH . '/lib/Jpl/Router.php';
require_once APPLICATION_PATH . '/lib/Jpl/View.php';
// ControllerBase contains all of the base functions necessary for
//   each controller class to process page logic as easily as
//   possible
class Jpl_Controller_Front {
    protected $view;    
    protected $_route;
    
    public function __construct() {    
	$this->view = new Jpl_View();
        
    }
    
    public final function run(){
    	$this->_route = JPL_Router::callControllerAction();
    	$this->view->render($this->_route);
    }
    
    public function __destruct(){
    	$this->_route = null;
    }
    
    
}
?>
