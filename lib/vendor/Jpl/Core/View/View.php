<?php

/**
 * Contains the View class
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
 * @since      v1.0
 *
 */
/**
 *
 * @package Jpl\Core
 */
namespace Jpl\Core\View;

use \Jpl\Core\Exception;
/**
 * The View/Template class
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.0
 *       
 */
class View
{

    /**
     * a list of view members
     *
     * @var array
     * @access private
     */
    private $_vars = array();
    /**
     * Holds the info for a custom defined view to load
     *
     * @var array
     * @access private
     */
    private $_view = null;
    /**
     * Instances of helper objects
     *
     * @var array
     * @access private
     */
    private $_helper = array();
    /**
     * Map of helper => class pairs to help in determining helper class from name
     *
     * @var array
     * @access private
     */
    private $_helperLoader = array();
    /**
     * Map of helper => classfile pairs to aid in determining helper classfile
     *
     * @var array
     * @access private
     */
    private $_helperLoaderDir = array();
    private $_loaders = array();
    private $_loaderTypes = array();

    /**
     * The default constructor
     *
     * @todo: add user-defined helper paths defined in config file 1.2.4
     * @todo: add user-defined view script paths from config 1.2.4
     */
    public function __construct ()
    {
        
    }

    /**
     * Render the view for the given controller and action
     *
     *
     * @todo Allow Partials v1.2.2
     * @todo Allow for view helpers v1.2.1
     *
     * @param array $view            
     * @throws \Exception
     */
    public function render (array $view)
    {
        if(is_null($this->_view)){
            $folder = strtolower($view[0]);
            $file = $view[1];
        }else{
            $folder = $this->_view[0];
            $file = $this->_view[1];
        }
        if (! file_exists(APPLICATION_PATH . "/view/scripts/{$folder}/{$file}.phtml")) {
            throw new Exception\InvalidView(
                "The view does not exist for the requested action: /view/scripts/{$folder}/{$file}.phtml"
            );
        }
        include APPLICATION_PATH . "/view/$folder/$file.phtml";
    }

    public function setView(array $view){
        $this->_view = $view;
    }

    /**
     * The magic set function
     *
     * @param string $key            
     * @param mixed $val            
     */
    public function __set ($key, $val)
    {
        if ('_' != substr($key, 0, 1)) {
            $this->_vars[$key] = $val;
        }
    }

    /**
     * The magic get function
     *
     * @param string $key            
     * @return null|mixed
     */
    public function __get ($key)
    {
        if(isset($this->_vars[$key]))
            return $this->_vars[$key];
        else
            return null;
    }

    public function __destruct(){
        $this->_view = null;
    }

    public function __call($name, $args){
        # is helper class loaded
        $helper = $this->getHelper($name);

        # call the helper method
        return call_user_func_array(array($helper, name), $args);

    }

    public function addHelperPath($path, $prefix = '\Jpl\Core\View\Helper'){
        return $this->_addPluginPath('helper', $prefix, (array) $path));
    }

    private function _addPluginPath($type, $prefix, array $paths){
        $loader = $this->getPluginLoader($type);
        foreach($paths as $path){
            $loader->addPrefixPath($prefix, $path);
        }
        return $this;
    }

    public function getPluginLoader($type){
        $type = strtolower($type);
        if(!in_array($type, $this->_loaderTypes)){
            throw new Exception\InvalidView(sprintf('Invalid plugin loader type "%s"; cannot retrieve', $type));
        }
        if(!array_key_exists($type, $this->_loaders)){
            $prefix = '\Jpl\Core\View\\';
            $pathPrefix = 'Jpl/Core/Views/';
            $pType = ucfirst($type);
            switch($type){
                case 'helper':
                    $prefix .= $pType;
                    $pathPrefix .= $pType;
                    $loader = new \Jpl\Core\Loader\Plugin(array($prefix=>$pathPrefix));
                    $this->_loaders[$type] = $loader;
                    break;
            }
        }
        return $this->_loaders[$type];
    }
}
