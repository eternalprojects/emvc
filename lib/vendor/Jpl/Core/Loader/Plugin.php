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

use Jpl\Core\Exception;

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
    /**
     * Class map cache file
     *
     * @var string
     * @staticvar
     * @access protected
     */
    protected static $_includeFileCache;
    /**
     * Instance of loaded plugin oaths
     *
     * @var array
     * @staticvar
     * @access protected
     */
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
            if(isset($this->_prefixToPaths[$prefix])){
                unset($this->_prefixToPaths[$prefix]);
                return true;
            }
            return false;
        }

        if($this->_useStaticRegistry){
            self::$_staticPrefixToPaths[$this->_useStaticRegistry] = array();
        }else{
            $this->_prefixToPaths = array();
        }
        return true;
    }
    public function removePrefixPath($prefix, $path = null){
        $prefix = $this->_formatPrefix($prefix);
        if($this->_useStaticRegistry){
            $registry =& self::$_staticPrefixToPaths[$this->_useStaticRegistry];
        }else{
            $registry =& $this->_prefixToPaths;
        }

        if(!isset($registry[$prefix])){
            // todo: create a real Exception class
            throw new Exception("Prefix ".$prefix." was not found in the Loader");
        }

        if($path != null){
            $pso = array_search($path, $registry[$prefix]);
            if(false === $pso){
                throw new Exception("Prefix ".$prefix." /path ".$path." was not found in the Loader");

            }
            unset($registry[$prefix][$pso]);
        }else{
            unset($registry[$prefix]);
        }
        return $this;
    }
    protected function _formatName($name){
        return ucfirst((string) $name);
    }

    public function isLoaded($name){
        $name = $this->_formatName($name);
        if($this->_useStaticRegistry){
            return isset(self::$_staticLoadedPlugins[$this->_useStaticRegistry][$name]);
        }
        return isset($this->_loadedPlugins[$name]);
    }

    public function getClassName($name){
        $name = $this->_formatName($name);
        if($this->_useStaticRegistry && isset(self::$_staticLoadedPlugins[$this->_useStaticRegistry][$name])){
            return self::$_staticLoadedPlugins[$this->_useStaticRegistry][$name];
        }elseif(isset($this->_loadedPlugins)){
            return $this->_loadedPlugins[$name];
        }
        return false;
    }

    public function getClassPath($name){
        $name = $this->_formatName($name);
        if($this->_useStaticRegistry && !empty(self::$_staticLoadedPluginPaths[$this->_useStaticRegistry][$name])){
            return self::$_staticLoadedPluginPaths[$this->_useStaticRegistry][$name];
        }elseif(isset($this->_loadedPluginPaths[$name])){
            return $this->_loadedPluginPaths[$name];
        }
        if($this->isLoaded($name)){
            $class = $this->getClassName($name);
            $r = new \ReflectionClass($class);
            $path = $r->getFileName();
            if($this->_useStaticRegistry){
                self::$_staticLoadedPluginPaths[$this->_useStaticRegistry][$name] = $path;
            }else{
                $this->_loadedPluginPaths[$name] = $path;
            }

            return $path;
        }
        return false;
    }

    public function load($name, $throwExceptions = true)
    {
        $name = $this->_formatName($name);
        if ($this->isLoaded($name)) {
            return $this->getClassName($name);
        }

        if ($this->_useStaticRegistry) {
            $registry = self::$_staticPrefixToPaths[$this->_useStaticRegistry];
        } else {
            $registry = $this->_prefixToPaths;
        }

        $registry  = array_reverse($registry, true);
        $found     = false;
        if (false !== strpos($name, '\\')) {
            $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $name) . '.php';
        } else {
            $classFile = str_replace('_', DIRECTORY_SEPARATOR, $name) . '.php';
        }
        $incFile   = self::getIncludeFileCache();
        foreach ($registry as $prefix => $paths) {
            $className = $prefix . $name;

            if (class_exists($className, false)) {
                $found = true;
                break;
            }

            $paths     = array_reverse($paths, true);

            foreach ($paths as $path) {
                $loadFile = $path . $classFile;
                // @todo: something
                if (Zend_Loader::isReadable($loadFile)) {
                    include_once $loadFile;
                    if (class_exists($className, false)) {
                        if (null !== $incFile) {
                            self::_appendIncFile($loadFile);
                        }
                        $found = true;
                        break 2;
                    }
                }
            }
        }

        if (!$found) {
            if (!$throwExceptions) {
                return false;
            }

            $message = "Plugin by name '$name' was not found in the registry; used paths:";
            foreach ($registry as $prefix => $paths) {
                $message .= "\n$prefix: " . implode(PATH_SEPARATOR, $paths);
            }

            throw new Exception($message);
        }

        if ($this->_useStaticRegistry) {
            self::$_staticLoadedPlugins[$this->_useStaticRegistry][$name]     = $className;
        } else {
            $this->_loadedPlugins[$name]     = $className;
        }
        return $className;
    }

}
