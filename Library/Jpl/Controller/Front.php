<?php

/**
 * Contains the Front Controller class
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
 *
 * @package Jpl\Controller
 */
namespace Jpl\Controller;

use Jpl\Router;
use Jpl\Exception\InvalidController;
use Jpl\Exception\InvalidAction;

/**
 * The Front Controller for dispatching requests
 *
 * The class dispatches the request to the router
 *
 * @package Jpl\Router
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.0
 *       
 */
class Front {
	/**
	 * Default constructor
	 *
	 * @access public
	 */
	public function __construct() {
	}
	/**
	 * Dispatches the request to the Router class
	 *
	 * @access public
	 * @final
	 *
	 */
	public final function run() {
		try {
			Router::callControllerAction ();
		} catch ( InvalidAction $e ) {
			$error = new \Controller\Error ();
			$error->errorAction ( $e );
		} catch ( InvalidController $e ) {
			$error = new \Controller\Error ();
			$error->errorAction ( $e );
		}
	}
}
?>
