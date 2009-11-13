<?php
/**
 * Contains the AutoLoader class
 * 
 * License:
 * 
 * Copyright (c) 2009, JPL Web Solutions, 
 *                     Jesse Lesperance <jesse@jplesperance.com>
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
 * @subpackage Loader
 * @author Jesse Lesperance <jesse@jplesperance.com>
 * @copyright 2009 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @version SVN: $Id$
 *
 */
/**
 * 
 * @author lesperancej
 *
 */
class Jpl_AutoLoader {
	/**
	 * 
	 */
	private function __construct() {
	
	}
	/**
	 * 
	 * @param unknown_type $class
	 */
	public static function AutoLoad($class){
		$parts = explode('_', $class);
		switch ($parts[0]){
			case 'Model':
				array_shift($parts);
				$path = APPLICATION_PATH . '/model/' . implode('/', $parts);
				break;
			default:
				$path = implode('/', $parts);
				break;
		}
		if (@include_once $path .'.php')
			return;
		
	}
}

?>