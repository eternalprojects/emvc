<?php
require_once './lib/simplemvcwf/route.php';
require_once './lib/simplemvcwf/router.php';

// The ViewHelper encloses any helper methods used to render or manipulate the view.
//   This is mostly empty for now, but there are a number of functions useful to working
//   with a view that could go in here.
class ViewHelper {   
    function __construct($router) {
    }
    
    // Creates a hyperlink url based on a controller and action
    static function createLinkUrl($controller, $action) {
        global $baseUrl;
        
        echo $baseUrl . '/' . $controller . '/' . $action;        
    }
    
    // Creates a hyperlink url based on a static file url
    static function createStaticUrl($url) {
        global $baseUrl;
        
        echo $baseUrl . '/static/' . $url;
    }
}
?>