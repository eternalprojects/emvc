<?php


// The ViewHelper encloses any helper methods used to render or manipulate the view.
//   This is mostly empty for now, but there are a number of functions useful to working
//   with a view that could go in here.
class Jpl_View_Helper_Url {   
    
	function __construct(Jpl_Router $router) {}
    
    // Creates a hyperlink url based on a controller and action
    static function createLinkUrl($controller, $action) {
        
        echo AppRegistry::get('baseUrl') . '/' . $controller . '/' . $action;        
    }
    
    // Creates a hyperlink url based on a static file url
    static function createStaticUrl($url) {
        
        echo AppRegistry::get('baseUrl') . '/static/' . $url;
    }
}
?>