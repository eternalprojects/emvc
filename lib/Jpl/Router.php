<?php
/**
 * Contains the AutoLoader class
 * 
 * License:
 * 
 * Copyright (c) 2009, JPL Web Solutions, 
 *                     Jesse Lesperance <jesse@jplesperance.com>
 * 
 * This file is part of JPL-MVC.
 * 
 * JPL-MVC is free software: you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published 
 * by the Free Software Foundation, either version 3 of the License, or 
 * (at your option) any later version.  JPL-MVC is distributed in the hope 
 * that it will be useful, but WITHOUT ANY WARRANTY; without even the 
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 * 
 * See the GNU General Public License for more details. You should have received 
 * a copy of the GNU General Public License along with JPL-MVC.  
 * 
 * If not, see <http://www.gnu.org/licenses/>.
 * 
 * @package MVC-Core
 * @subpackage Router
 * @author Jesse Lesperance <jesse@jplesperance.com>
 * @copyright 2009 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @version SVN: $Id$
 *
 */
/**
 * A class for registering and calling defined routes
 *  
 * @package MVC-Core
 * @subpackage Router
 * @author jesse Lesperance <jesse@jplesperance.com>
 *
 */
class Jpl_Router {
	/**
	 * an array of all the registered routes
	 * 
	 * @var array
	 * @access private
	 */
    private $_routes = array();
    /**
     * defualt constructor
     * 
     * @access public
     */
    public function __construct() {        
    }
   	/**
   	 * registers the predefined route
   	 * 
   	 * This function accepts an instance of the Jpl_Route object that was created 
   	 * when defining a custom route
   	 * 
   	 * @access public
   	 * @param Jpl_Route $route
   	 * @see Jpl_Route::__construct()
   	 */
    public function registerRoute(Jpl_Route $route) {
        $this->_routes[] = $route;        
    }
    /**
     * gets the corresponding defined route
     * 
     * @param string $santitizedUrl
     * @return Jpl_Route
     * @access private
     */
    private function _getMatchingRoute($santitizedUrl) {
        foreach ($this->_routes as &$route) {            
            if ($route->isMatch($santitizedUrl)) {
                return $route;            
            }else{
                return false;
            }
        }
    }
    /**
     * calls the action and controller matching the route
     * 
     * @access public
     */
    public function callControllerAction() {
        $route = (isset($_GET['route']))?trim($_GET['route']):'index/index';
        if($matchedRoute = $this->_getMatchingRoute($route)){
            $controllerPart = $matchedRoute->getControllerName();
            $controllerName = $controllerPart . 'Controller';
            $controller = new $controllerName();
            $actionPart = $matchedRoute->getActionName();
            $actionName = $actionPart . 'Action';
            $controller->$actionName();
            return array($controllerPart, $actionPart);
        }else{
            $routeArray = explode('/',$route);
            $controllerPart = ucfirst($routeArray[0]);
            $controllerName = $controllerPart . 'Controller';
            $controller = new $controllerName();
            $actionPart = (isset($routeArray[1]))?$routeArray[1]:'index';
            $actionPart = $actionName . 'Action';
            $controller->$actionName();
            return array($controllerPart, $actionPart);
        }
    }
}
?>
