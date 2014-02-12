<?php

/**
 * This file contains the interface for the Registry classes
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
 * (at your option) any later version.  EternalMVC is distributed in the hope
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
 * @since     v1.0
 * @link      http://www.eternalmvc.info
 *            http://www.eternalprojects.com
 *            http://www.jplesperance.me
 * @package   Jpl\Core\Registry
 *
 */
/**
 *
 * @package Jpl\Core\Registry
 */
namespace Jpl\Core;

/**
 * The interface for all Registry classes to inherit
 *
 * This interface acts as a blue print and defines what method and members each
 * class that implements it must implement. Currently only the magic getter
 * and setter functions are required to be implemented
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @since v1.0
 */
interface Registry
{

    /**
     * The __get magic function
     *
     * @param string $name            
     */
    static function get ($name);

    /**
     * The magic __set function
     *
     * @param string $name            
     * @param mixed $value            
     */
    static function set ($name, $value);
}
