<?php
// ViewData is the simple data structure used to wrap the data passed from
//   the controller to the view
class Jpl_View  {
    private $vars = array();

    function __construct() {        
    }

    public function render($view){
    	include APPLICATION_PATH . '/view/'.strtolower($view[0]).'/'.$view[1].'.phtml';
    }

}
?>