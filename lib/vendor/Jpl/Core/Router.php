<?php

/**
 * Contains the Router class
 *
 * License:
 *
 * Copyright (c) 2010-2014, JPL Web Solutions,
 * Jesse P Lesperance <jesse@jplesperance.me>
 *
 * This file is part of EternalMVC.
 *
 * EternalMVC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.  EternalMVC is distributed in the hope
 * that it will be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * See the GNU General Public License for more details. You should have
 * received a copy of the GNU General Public License along with EternalMVC.
 *
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2014 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     v1.0
 * @link      http://www.eternalmvc.info
 *            http://www.eternalprojects.com
 *            http://www.jplesperance.me
 * @package   Jpl\Core\Router
 *
 */
/**
 *
 * @package Jpl\Core\Router
 */
namespace Jpl\Core;
use \Jpl\Core\Route;
use \Jpl\Core\Exception;
use \Jpl\Core\Uri;

/**
 * The Router class
 *
 * The Router class analyzes the URI and determines the appropriate controller
 * and action to call. It knows how to route default routes but can also handle
 * routing custom defined routes.
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2014 JPL Web Solutions
 * @since v1.0
 *       
 */
class Router
{

    /**
     * an array of all the registered routes
     *
     * @var array a list of registered routes
     */
    private static $_routes = array();

    /**
     * registers the predefined route
     *
     * This function accepts an instance of the Jpl_Route object that was
     * created when defining a custom route
     *
     * @access public
     * @param \Jpl\Core\Route $route
     *
     * @see \Jpl\Core\Route
     */
    public static function registerRoute (Route $route)
    {
        self::$_routes[] = $route;
    }

    /**
     * gets the corresponding defined route
     *
     * @param string $santitizedUrl            
     * @internal
     * @return \Jpl\Core\Route|false
     *
     */
    private static function _getMatchingRoute ($santitizedUrl)
    {
        foreach (self::$_routes as $route) {
            if ($route->isMatch($santitizedUrl)) {
                return $route;
            }
        }
        return false;
    }

    /**
     * calls the action and Controller matching the route
     *
     * @throws Jpl\Core\Exception\InvalidController
     * @throws Jpl\Core\Exception\InvalidAction
     * @return void
     */
    public static function callControllerAction ()
    {
        $route = (isset($_SERVER['REQUEST_URI'])) ? trim($_SERVER['REQUEST_URI']) : 'index/index';
        /**
         * Try to match a defined route, if unable, try and match an organic
         * route
         */
        $matchedRoute = self::_getMatchingRoute($route);
        $routeArray = explode('/', $route);

        if ($matchedRoute != false) {
            $controllerPart = ucwords(
                strtolower($matchedRoute->getControllerName())
            );
            
            $actionPart = strtolower($matchedRoute->getActionName());
        } else {

            $controllerPart = ucwords(strtolower($routeArray[0]));
            $actionPart = ($routeArray[1] == "") ? 'index' : $routeArray[1];
        }

        //TODO: This will not work for defined routes - v1.3.1 - EMVC-12
        $routeArray = array_slice($routeArray, 2);
        $params = array();
        while(count($routeArray) > 1){
            $params[$routeArray[0]] = $routeArray[1];
            $routeArray = array_slice($routeArray, 2);
        }
        $controllerName = '\Controller\\' . $controllerPart;
        // Check to see if the controller class exists, if not throw an
        // exception

        if (\Jpl\Core\AutoLoader::AutoLoad($controllerName)) {
            $controller = new $controllerName(
                    array(
                            $controllerPart,
                            $actionPart
                    ), null, $params
            );
        } else {
            throw new Exception\InvalidController($controllerName . ": Does not exist.");
        }
        $actionName = strtolower($actionPart) . 'Action';
        
        if (method_exists($controllerName, $actionName)) {
            $controller->$actionName();
        } else {
            throw new Exception\InvalidAction($actionName . ": Does not exist in " . $controllerName);
        }
    }


}
