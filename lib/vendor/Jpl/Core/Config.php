<?php
/**
 * Contains the Config class
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
 * (at your option) any later version.  JPL-MVC is distributed in the hope
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
 * @since     v1.2
 * @package   Jpl\Core\Config
 * @link      http://www.eternalmvc.info
 *            http://www.eternalprojects.com
 *            http://www.jplesperance.me
 * @package   Jpl\Core\Config
 */
/**
 *
 * @package Jpl\Core\Config
 */
namespace Jpl\Core;
/**
 * A class that contains a common function used by all Config Classes
 *
 * The purpose of the class is to load the specified config file that is in Json
 * format. Convert it into an object and pass it back to the calling code.
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2014 JPL Web Solutions
 * @since v1.2
 * @todo Convert to Trait - v1.3.1 - EMVC-10
 * @link http://jira.eternalprojects.com
 *
 */
abstract class Config
{

    /**
     * @var string The folder that config files are stored in
     */
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

    /**
     * Sets the folder where the config files are stored
     *
     * @param string $folder the directory
     *
     * @throws Exception\InvalidConfig
     * @return boolean|void
     */
    public function setConfigFolder($folder){
        if(is_dir($folder)){
            $this->_configFolder = $folder;
	        return true;
        }
        throw new \Jpl\Core\Exception\InvalidConfig("The config folder you specified does not exist");
    }
}
