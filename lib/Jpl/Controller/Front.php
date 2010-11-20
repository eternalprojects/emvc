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
    
    public function __construct() {    
        
    }
    
    public final function run(){
    	JPL_Router::callControllerAction();
    }
    
}
?>
