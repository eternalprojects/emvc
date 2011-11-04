<?php
/**
 * Contains the View Class
 * 
 * License:
 * 
 * Copyright (c) 2009, JPL Web Solutions, 
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
 * @subpackage View
 * @author Jesse Lesperance <jesse@jlesperance.com>
 * @copyright 2009 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @version SVN: $Id$
 *
 */
/**
 * The View/Template class
 * 
 * @package MVC-Core
 * @subpackage View
 * @author jesse Lesperance <jesse@jlesperance.com>
 *
 */
class Jpl_View
{
    /**
     * an array of view members
     * 
     * @var array
     */
    private $vars = array();
    /**
     * The default constructor
     */
    public function __construct ()
    {}
    /**
     * 
     * @param array $view
     */
    public function render (array $view)
    {
        $folder = strtolower($view[0]);
        $file = $view[1];
	if(!file_exists(APPLICATION_PATH . "/view/{$folder}/{$file}.phtml"))
		throw new Exception("The view does not exist for the requested action");
        include APPLICATION_PATH . "/view/$folder/$file.phtml";
    }
    /**
     * 
     * @param string $key
     * @param mixed $val
     */
    public function __set ($key, $val)
    {
        if ('_' != substr($key, 0, 1)) {
            $this->vars[$key] = $val;
        }
        return;
    }
    /**
     * 
     * @param string $key
     * @return mixed
     */
    public function __get ($key)
    {
        return $this->vars[$key];
    }
}
