<?php
// Route serves as a container for specifying a url route
//   that points to a controller and view
class Route {
    private $url = '';
    private $controllerName = '';
    private $actionName = '';    
    
    function __construct($url, $controllerName, $actionName) {
        $this->url = $url;
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }
    
    function getUrl() {
        return $this->url;
    }
    
    function getControllerName() {
        return $this->controllerName;
    }
   
    function getActionName() {
        return $this->actionName;
    }
    
    // Determines whether the specified url matches the route
    // Note: this function can return true for any url that starts
    //   with the route's url property. It is therefore important that
    //   routes be ordered from most specific to least specific in
    //   the index.php page.
    function isMatch($url) {
        if ($this->url == substr($url, 0, strlen($this->url)))        
            return true;
        else
            return false;
    }
}
?>