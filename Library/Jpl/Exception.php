<?php
/**
 * Contains the AutoLoader class
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
 * @package Jpl
 */
namespace Jpl;
/**
 * The Exception class specific to the MVC framewprk
 *
 * This class is used to throw exceptions that happen in the EternalMVC framework. This class has
 * some additional functionality for handling and logging exceptions thrown.
 *
 * @package   Jpl\Exception
 * @see       \Exception::__construct
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     v1.0
 * 
 */
class Exception extends \Exception
{
	/**
	 * class constructor which calls parent constructor
	 * 
	 * @param string $message
	 * @param int $code
	 */
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}

?>