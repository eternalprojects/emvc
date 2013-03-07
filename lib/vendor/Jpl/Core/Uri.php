<?php
/**
 * Contains the Uri manipulation class
 *
 * License:
 *
 * Copyright (c) 2010-2012, JPL Web Solutions,
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
 * @package    Jpl\Core
 * @author     Jesse Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2012 JPL Web Solutions
 * @link      http://www.eternalmvc.info
 * @license    http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since      v1.2
 *
 */
/**
 *
 * @package Jpl\Core
 */
namespace Jpl\Core;

/**
 * The Uri manipulation class
 *
 * This class will process the incoming url, extract the controller and action
 * names and make an array of the parameters.
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @link http://www.eternalmvc.info
 * @since v1.2
 *       
 */
class Uri
{

    /**
     * Holds parameters from the Url
     *
     * @access protected
     * @staticvar array
     */
    protected static $_param = array();

    /**
     * Holds the controller name from the url
     *
     * @staticvar string
     * @access protected
     */
    protected static $_controller;

    /**
     * Holds the action name from the url
     *
     * @access protected
     * @staticvar string
     */
    protected static $_action;

    /**
     * Holds an instance of this class
     *
     * @access private
     * @staticvar \Jpl\Core\Uri
     */
    private static $_instance = null;

    /**
     * Method to retrieve the controller property
     *
     * @access public
     * @static
     *
     * @return string the name of the controller
     */
    public static function getController ()
    {
        self::getInstance();
        return Uri::$_controller;
    }

    /**
     * get the controller name
     *
     * @access public
     * @static
     *
     * @param string $_controller            
     * @return boolean
     */
    public static function setController ($_controller)
    {
        self::getInstance();
        self::$_controller = $_controller;
        return (self::$_controller == $_controller) ? true : false;
    }

    /**
     * retrieve an instance of the class
     *
     * @access public
     * @static
     *
     * @return \Jpl\Core\Uri
     */
    public static function getInstance ()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Uri();
        }
        return self::$_instance;
    }

    /**
     * the class constructor
     *
     * When the class is instantiated, the url is parsed and made into an array
     *
     * @access private
     * 
     * @return void
     */
    private function __construct ()
    {
        if(isset($_GET['route']) &&  !empty($_GET['route'])){
            $params = explode('/', $_GET['route']);
        }else{
            $params = array('index', 'index');
        }
        self::$_controller = $params[0];
        self::$_action = $params[1];
        $params = array_slice($params, 2);
        $p = array();
        while(count($params) > 1){
            $p[$params[0]] = $params[1];
            array_slice($params, 2);
        }
        self::$_param = $p;
    }

   /**
     * set the action
     *
     * @access public
     * @static
     *
     * @param string $action            
     * @return boolean
     */
    public static function setAction ($action)
    {
        self::getInstance();
        self::$_action = $action;
        return (self::$_action == $action) ? true : false;
    }

    /**
     * get the requested action
     *
     * @access public
     * @static
     *
     * @return string
     */
    public static function getAction ()
    {
        self::getInstance();
        return self::$_action;
        error_log(self::$_action);
    }

    /**
     * get a specific parameter
     *
     * @access public
     * @static
     *
     * @param int $key            
     * @return Ambigous <boolean, string>
     */
    public static function getParam ($key)
    {
        self::getInstance();
        return (array_key_exists($key, self::$_param)) ? self::$_param[$key] : false;
    }

    /**
     * get all the parameters
     *
     * @access public
     * @static
     *
     * @return Ambigous <boolean, array>
     */
    public static function getParams ()
    {
        self::getInstance();
        return (count(self::$_param) > 0) ? self::$_param : false;
    }

    /**
     * set a paremeter
     *
     * @access public
     * @static
     *
     * @param string $key            
     * @param mixed $val            
     * @return boolean
     */
    public static function setParam ($val, $key = null)
    {
        self::getInstance();
        $key = (empty($key))? count(self::$_param) : $key;
        self::$_param[$key] = $val;
        return (! empty(self::$_param[$key])) ? true : false;
    }
    
    public static function resetInstance()
    {
        if (!is_null(self::$_instance)) {
            self::$_instance = null;
        }
    }
}