<?php
/**
 * Contains the Config class
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
 * @package   \Jpl\Core
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @link      http://www.eternalmvc.info
 * @link      http://www.jplwebsolutions.com
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     EternalMVC 1.2
 *
 */
/**
 *
 * @package Jpl\Core
 */
namespace Jpl\Core;
/**
 * A class that contains a common function used by all Config Classes
 *
 * The purpose of the class is to load the specified config file that is in Json
 * format. Convert it into an object and pass it back to the calling code.
 *
 * @access public
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since EternalMVC 1.2
 * @version 1.0
 * @link http://www.eternalmvc.info
 * @todo Convert to Trait
 */
abstract class Config
{
    protected $_configFolder = '/configs/';
    /**
     * A method to convert arrays to objects
     *
     * @access protected
     * @param mixed $array
     * @return array|\stdClass|boolean
     * 
     */
    protected function _toObject ($array)
    {
        if (! is_array($array)) {
            return $array;
        }
    
        $object = new \stdClass();
    
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $name => $value) {
                $name = strtolower(trim($name));
                if (! empty($name)) {
    
                    $object->$name = $this->_toObject($value);
                }
            }
            return $object;
        } else {
            return FALSE;
        }
    }

    public function setConfigFolder($folder){
        if(is_dir($folder)){
            $this->_configFolder = $folder;
        }
        throw new \Jpl\Core\Exception\InvalidConfig("The config folder you specified does not exist");
    }
}
