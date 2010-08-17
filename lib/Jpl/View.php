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
    	include "/view/$folder/$file.phtml";
    }

}
