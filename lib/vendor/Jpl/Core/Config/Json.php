<?php
/**
 * Contains the Json Config class
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
 * @package   \Jpl\Core\Config
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     1.2
 * @link      http://www.eternalmvc.info
 *
 */
/**
 *
 * @package Jpl\Core\Config
 */
namespace Jpl\Core\Config;

/**
 * A class to load and process Json config files
 *
 * The purpose of the class is to load the specified config file that is in Json
 * format. Convert it into an object and pass it back to the calling code.
 *
 * @access public
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since 1.2
 * @version 1.0
 * @link http://www.eternalmvc.info
 *      
 */
class Json
{

    /**
     * Class contructor
     *
     * The constructor will load the file given, if it exists. Once loaded it
     * decodes it to an array which gets passed to the _toObject function and
     * then gets returned
     *
     * @todo Implement use of the $section param
     * @access public
     * @param string $file            
     * @param string $section            
     * @return \stdClass
     * @since 1.2
     */
    public function __construct ($file, $section = null)
    {
        $data = file_get_contents($file);
        $data = json_decode($data);
        $json = $this->_toObject($data);
        return $json;
    }

    /**
     * A method to convert arrays to objects
     *
     * @access protected
     * @param string|array|boolean $array            
     * @return string \stdClass boolean
     * @since 1.2
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
    
}

