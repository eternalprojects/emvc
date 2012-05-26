<?php

/**
 * Contains the application registry class
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
 * @author     Jesse Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2012 JPL Web Solutions
 * @link      http://www.eternalmvc.info
 * @license    http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since      v1.0
 *
 */
/**
 *
 * @package Jpl\Registry
 */
namespace Jpl\Registry;
use \Jpl\Registry\Registry;

/**
 * A class acting as a registry
 *
 * This class implements the Registry pattern. It is used to store application
 * based data and settings so that the information is accessable from all parts
 * of the application
 *
 * @package Jpl\Registry\Registry
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.0
 *       
 */
class Application implements Registry
{

    /**
     * a reference to this class
     *
     * @var Jpl\Registry\Application
     * @staticvar
     *
     *
     *
     *
     * @access private
     */
    private static $_instance;

    /**
     * Contains the stored data of the registry
     *
     * @var array
     * @access private
     */
    private $_data = array();

    /**
     * The default constructor
     *
     * @access private
     */
    private function __construct ()
    {}

    /**
     * a method that returns an instance of the class
     *
     * @static
     *
     *
     *
     *
     *
     * @access public
     * @return Jpl_Registry_Application
     */
    public static function getInstance ()
    {
        if (! isset(self::$_instance))
            self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Adds data to the registry
     *
     * @param string $name            
     * @param mixed $value            
     * @access public
     */
    public function set ($name, $value)
    {
        self::getInstance()->_data[$name] = $value;
    }

    /**
     * retrieves data from the registry
     *
     * @param string $name            
     * @access public
     * @return mixed|false
     */
    public function get ($name)
    {
        return (isset(self::getInstance()->_data[$name])) ? self::getInstance()->_data[$name] : false;
    }

    /**
     * adds data to the registry
     *
     * @param string $name            
     * @param mixed $value            
     * @static
     *
     *
     *
     *
     *
     */
    public static function set ($name, $value)
    {
        self::getInstance()->_data[$name] = $value;
    }

    /**
     * retrieves data from the registry
     *
     * @param string $name            
     * @return mixed null
     * @static
     *
     *
     *
     *
     *
     */
    public static function get ($name)
    {
        return (isset(self::getInstance()->_data[$name])) ? self::getInstance()->_data[$name] : null;
    }
}