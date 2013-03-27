<?php

/**
 * Contains the AutoLoader class
 *
 * License:
 *
 * Copyright (c) 2010, JPL Web Solutions,
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
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     v1.2.1
 * @link      http://www.eternalmvc.info
 *
 */
/**
 *
 * @package Jpl\Core\Loader
 */
namespace Jpl\Core\Loader;

/**
 * A generic plugin class loader
 *
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2013 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.2.1
 * @link http://www.eternalmvc.info
 *
 */
class Plugin
{
    protected static $_includeFileCache;
    protected $_loadedPluginPaths = array();
    protected $_loadedPlugins = array();
    protected $_prefixToPaths = array();
    protected static $_staticPrefixToPaths = array();
    protected static $_staticLoadedPluginPaths = array();
    protected static $_staticLoadedPlugins = array();
    protected $_useStaticRegistry = null;

    public function __construct(array $prefixToPaths = array(), $staticRegistryName = null){
        if(is_string($staticRegistryName) && !empty($staticRegistryName)){
            $this->_useStaticRegistry = $staticRegistryName;
            if(!isset(self::$_staticPrefixToPaths[$staticRegistryName])){
                self::$_staticPrefixToPaths[$staticRegistryName] = array();
            }
            if(!isset(self::$_staticLoadedPlugins[$staticRegistryName])){
                self::$_staticLoadedPlugins[$staticRegistryName] = array();
            }
        }

        foreach($prefixToPaths as $prefix => $path){
            $this->addPrefixPath($prefix, $path);
        }
    }
    protected function _formatPrefix($prefix){
        if($prefix == "")
            return $prefix;

        $nsSeparator = (false !== strpos($prefix,'\\'))?'\\':'_';
        return rtrim($prefix, $nsSeparator) . $nsSeparator;
    }
    public function addPrefixPath($prefix, $path){
        if(!is_string($prefix) || !is_string($path))
            throw new \Jpl\Core\Exception('\Jpl\Core\Loader\Plugin::addPrefixPath() method only accepts strings for prefix and path');
        $prefix = $this->_formatPrefix($prefix);
        $path = rtrim($path, '/\\') . '/';

        if($this->_useStaticRegistry){
            self::$_staticPrefixToPaths[$this->_useStaticRegistry][$prefix][] = $path;
        }else{
            if(!isset($this->_prefixToPaths[$prefix])){
                $this->_prefixToPaths[$prefix] = array();
            }
            if(!in_array($path, $this->_prefixToPaths[$prefix])){
                $this->_prefixToPaths[$prefix][] = $path;
            }
        }
        return $this;
    }
    public function getPaths($prefix = null){
        if((null !== $prefix) && is_string($prefix)){
            $prefix = $this->_formatPrefix($prefix);
            if($this->_useStaticRegistry){
                if(isset(self::$_staticPrefixToPaths[$this->_useStaticRegistry][$prefix])){
                    return self::$_staticPrefixToPaths[$this->_useStaticRegistry][$prefix];
                }
                return false;
            }
            if(isset($this->_prefixToPaths[$prefix])){
                return $this->_prefixToPaths[$prefix];
            }
            return false;
        }
        if($this->_useStaticRegistry){
            return self::$_staticPrefixToPaths[$this->_useStaticRegistry];
        }
        return $this->_prefixToPaths;
    }
    public function clearPaths($prefix = null){
        if((null !== $prefix) && is_string($prefix)){
            $prefix = $this->_formatPrefix($prefix);
            if($this->_useStaticRegistry){
                if(isset(self::$_staticPrefixToPaths[$this->_useStaticRegistry][$prefix])){
                    unset(self::$_staticPrefixToPaths[$this->_useStaticRegistry][$prefix]);
                    return true;
                }
                return false;
            }
            if(isset($this->_prefixToPaths))
    }
}
