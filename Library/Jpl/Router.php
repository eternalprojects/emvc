<?php
/**
 * Contains the Router class
 *
 * License:
 *
 * Copyright (c) 2010-2012, JPL Web Solutions,
 * Jesse P Lesperance <jesse@jplesperance.me>
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
 * See the GNU General Public License for more details. You should have
 * received a copy of the GNU General Public License along with JPL-MVC.
 *
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    Jpl
 * @subpackage Exception
 * @author     Jesse Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2012 JPL Web Solutions
 * @license    http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since      v0.2
 *
 */
/**
 * @package Jpl
 */
namespace Jpl;
use \Jpl\Route;

/**
 * The Router class
 *
 * The Router class analyzes the URI and determines the appropriate controller
 * and action to call.  It knows how to route default routes but can also handle
 * routing custom defined routes.
 *
 * @package   Jpl\Router
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     v0.2
 * @link      http://www.eternalmvc.info
 */
class Router
{
    /**
     * an array of all the registered routes
     *
     * @var array a list of registered routes
     * @static
     * @access private
     */
    private static $_routes = array();

    /**
     * registers the predefined route
     *
     * This function accepts an instance of the Jpl_Route object that was
     * created when defining a custom route
     *
     * @access public
     *
     * @param \Jpl\Route $route
     *
     * @static
     * @see    \Jpl\Route
     */
    public static function registerRoute(Route $route)
    {
        self::$_routes[] = $route;
    }

    /**
     * gets the corresponding defined route
     *
     * @param string $santitizedUrl
     *
     * @return \Jpl\Route
     * @access private
     */
    private function _getMatchingRoute($santitizedUrl)
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
     * @access public
     * @static
     * @throw  JPL_Exception_InvalidController
     */
    public static function callControllerAction()
    {
        $route = (isset($_GET['route'])) ?
            trim($_GET['route']) : 'index/index';
        if ($matchedRoute = self::_getMatchingRoute($route)) {
            $controllerPart = $matchedRoute->getControllerName();
            $controllerName = $controllerPart . 'Controller';
            $actionPart     = $matchedRoute->getActionName();
        } else {
            $routeArray     = explode('/', $route);
            $controllerPart = ucfirst($routeArray[0]);
            $controllerName = $controllerPart . 'Controller';
            $actionPart     = (isset($routeArray[1]) && $routeArray[1] != '') ? $routeArray[1] : 'index';
        }
        if (class_exists($controllerName)) {
            $controller = new $controllerName(
                array($controllerPart, $actionPart)
            );
        } else {
            throw new Jpl_Exception_InvalidController($controllerName .
                "Does not exist.");
        }
        $actionName = $actionPart . 'Action';
        if (method_exists($controllerName, $actionName)) {
            $controller->$actionName();
        } else {
            throw new Jpl_Exception_InvalidAction($actionName .
                "Does not exist in " . $controllerName);
        }
    }
}