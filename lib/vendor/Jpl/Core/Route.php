<?php

/**
 * Contains the Route class
 *
 * License:
 *
 * Copyright (c) 2010-2014, JPL Web Solutions,
 * Jesse Lesperance <jesse@jlesperance.com>
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
 * See the GNU General Public License for more details. You should have received
 * a copy of the GNU General Public License along with EternalMVC.
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
 * @package   Jpl\Core\Route
 *
 */
/**
 *
 * @package Jpl\Core\Route
 */
namespace Jpl\Core;

/**
 * A class to define custom URL routes
 *
 * This class contains methods for defining custom URL routes and mapping them
 * to the appropriate Controller and actions
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2014 JPL Web Solutions
 * @since v1.0
 */
class Route
{

    /**
     * the url to be mapped
     *
     * @var string
     *
     */
    private $_url;

    /**
     * the Controller that the url maps to
     *
     * @var string
     *
     */
    private $_controllerName;

    /**
     * the action the url maps to
     *
     * @var string
     *
     */
    private $_actionName;

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
     * @return void
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
     *
     * @return string the mapped url
     */
    public function getUrl ()
    {
        return $this->_url;
    }

    /**
     * get the mapped Controller name
     *
     *
     * @return string the mapped Controller name
     */
    public function getControllerName ()
    {
        return $this->_controllerName;
    }

    /**
     * retrieve the mapped action name
     *
     *
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
     *
     * @todo make this match a defined route exactly v1.3ish
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
