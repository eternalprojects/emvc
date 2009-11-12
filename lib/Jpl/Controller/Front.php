<?php
require_once './model/dbconfig.php';

// ControllerBase contains all of the base functions necessary for
//   each controller class to process page logic as easily as
//   possible
abstract class Jpl_Controller_Front {
    protected $viewData;    
    
    function __construct() {
        $this->view = new Jpl_View();
    }
    
    public function run(){
    	
    }
    
    public function __destruct(){
    	$this->view->render();
    }
    
    
}
?>