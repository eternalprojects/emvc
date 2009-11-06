<?php
// The Router class stores Routes and handles all MVC related
//   routing logic
class Router {
    private $routes = array();
    
    function __construct() {        
    }
   
    function registerRoute($route) {
        $this->routes[] = $route;        
    }
    
    // Gets the Route for the current request
    function getCurrentRoute() {
        $santitizedUrl = '';        
        if (!empty($_GET['route'])) {
            $santitizedUrl = trim($_GET['route']);
        }
        
        return $this->getMatchingRoute($santitizedUrl);
    }    
    
    // Gets the registered route that matches the specified
    //   sanitized url
    function getMatchingRoute($santitizedUrl) {
        
        foreach ($this->routes as &$route) {            
            if ($route->isMatch($santitizedUrl)) {
                return $route;            
            }
        }
        
        return null;
    }
    
    // Calls the controller's action that the matching route points to
    function callControllerAction() {
        $santitizedUrl = '';        
        if (!empty($_GET['route'])) {
            $santitizedUrl = trim($_GET['route']);
        }

        $route = $this->getMatchingRoute($santitizedUrl);
        if ($route != null) {
            $actionValues = explode('/', ltrim(str_replace($route->getUrl(), '', $santitizedUrl), '/'));
            $controllerName = $route->getControllerName();
            $controllerName = $controllerName . 'Controller'; 
            $controller = new $controllerName;
            $action = $route->getActionName();
            $controller->$action($actionValues);
        } else {
            // If we've entered this else section, we've effectively been unable to match
            //   the specified url to a registered route. Normally we would throw a 404
            //   error and return a user friendly message stating so, however, I'm leaving
            //   that as an exersize for the reader
        }
        
    }
}
?>