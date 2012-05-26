<?php

/**
 * Contains the Route class
 *
 * License:
 *
 * Copyright (c) 2009, JPL Web Solutions,
 * Jesse Lesperance <jesse@jlesperance.com>
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
 * @package    Jpl
 * @author     Jesse Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2012 JPL Web Solutions
 * @license    http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since      v1.0
 *
 */
/**
 *
 * @package Jpl
 */
namespace Jpl;

/**
 * A class to define custom URL routes
 *
 * This class contains methods for defining custom URL routes and mapping them
 * to the appropriate Controller and actions
 *
 * @package Jpl\Route
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @since v1.0
 */
class Route
{

    /**
     * the url to be mapped
     *
     * @var string
     * @access private
     */
    private $_url;

    /**
     * the Controller that the url maps to
     *
     * @var string
     * @access private
     */
    private $_controllerName;

    /**
     * the action the url maps to
     *
     * @var string
     * @access private
     */
    private $_actionName;

    /**
     * The parameters to pass to the action
     *
     * @var array
     * @access private
     */
    private $_params;

    /**
     * the constructor method builds the mapping
     *
     * takes the supplied 2 part url: /some/thing and allows you to specify the
     * contrller name and action that the url will map to
     *
     * @param string $url
     *            the url to be mapped
     * @param string $controllerName
     *            the Controller name for the mapping
     * @param string $actionName
     *            the action name for the mapping
     *            
     * @access public
     */
    public function __construct ($url, $controllerName, $actionName)
    {
        $this->_url = $url;
        $this->_controllerName = ucwords($controllerName);
        $this->_actionName = $actionName;
    }

    /**
     * retrieve the mapped url
     *
     * @access public
     * @return string the mapped url
     */
    public function getUrl ()
    {
        return $this->_url;
    }

    /**
     * get the mapped Controller name
     *
     * @access public
     * @return string the mapped Controller name
     */
    public function getControllerName ()
    {
        return $this->_controllerName;
    }

    /**
     * retrieve the mapped action name
     *
     * @access public
     * @return string the mapped action name
     */
    public function getActionName ()
    {
        return $this->_actionName;
    }

    /**
     * check to see if the requested url matches a defined route
     *
     * This checks to see if the specified url matches a defined route.
     * Currently
     * this will return as a match if beginning of the url provided matches a
     * defined route.
     *
     * @access public
     * @todo make this match a defined route exactly
     *      
     * @param string $url
     *            the url to be matched
     *            
     * @return boolean
     */
    public function isMatch ($url)
    {
        return ($this->_url == substr($url, 0, strlen($this->_url))) ? true : false;
    }
}

?>