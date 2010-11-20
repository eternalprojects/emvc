<?php
/**
 * The base interface for the Registry
 * 
 * License:
 * 
 * Copyright (c) 2010, JPL Web Solutions, 
 * Jesse Lesperance <jesse@jlesperance.com>
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
 * See the GNU General Public License for more details. You should have received 
 * a copy of the GNU General Public License along with JPL-MVC.  
 * 
 * If not, see <http://www.gnu.org/licenses/>.
 * 
 * @package MVC-Core
 * @subpackage Registry
 * @author Jesse Lesperance <jesse@jlesperance.com>
 * @copyright 2010 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @version SVN: $Id$
 *
 */
/**
 * The interface for all Registry classes to inherit
 * 
 * This interface acts as a blue print and defines what method and members each 
 * class that implements it must implement
 * 
 * @package MVC-Core
 * @subpackage Registry
 * @author jesse Lesperance <jesse@jlesperance.com>
 *
 */
Interface Jpl_Registry_Interface
{
    /**
     * The __get magic function
     * 
     * @param string $name
     */
    protected function __get ($name);
    /**
     * The magic __set function 
     * 
     * @param string $name
     * @param mixed $value
     */
    protected function __set ($name, $value);
}
?>