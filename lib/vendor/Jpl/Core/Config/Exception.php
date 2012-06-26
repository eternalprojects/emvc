<?php
/**
 * Contains Config Exception class
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
 * @package    Jpl\Config
 * @author     Jesse Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2012 JPL Web Solutions
 * @link      http://www.eternalmvc.info
 * @license    http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since      v1.2
 *
 */
/**
 *
 * @package Jpl\Config
 */
namespace Jpl\Config;

/**
 * The Exception class specific to the Config Classes
 *
 * This class is thrown when various issues happen in the config classes
 *
 * @uses \Exception
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.2
 *       
 */
class Exception extends \Exception
{

    /**
     * The constructor
     *
     * The constructor passes the supplied params up to the \Exception class
     *
     * @access public
     * @param string $message            
     * @param int $code            
     * @return void
     *
     * @see \Exception::__constructor()
     */
    public function __construct ($message, $code = null)
    {
        parent::__construct($message, $code);
    }
}

?>