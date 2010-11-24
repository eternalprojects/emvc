<?php
/**
 * Contains the Front Controller
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
 * @subpackage Controller
 * @author Jesse Lesperance <jesse@jlesperance.com>
 * @copyright 2010 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @version SVN: $Id$
 *
 */
require_once APPLICATION_PATH . '/lib/Jpl/Router.php';
require_once APPLICATION_PATH . '/controller/ErrorController.php';
require_once APPLICATION_PATH . '/lib/Jpl/Exception/InvalidAction.php';
require_once APPLICATION_PATH . '/lib/Jpl/Exception/InvalidController.php';
/**
 * The Front Controller for dispatching requests
 * 
 * The class dispatches the request to the router
 * 
 * @package MVC-Core
 * @subpackage Controller
 * @author jesse Lesperance <jesse@jlesperance.com>
 *
 */
class Jpl_Controller_Front
{
    /**
     * Default constructor
     * 
     * @access public
     */
    public function __construct ()
    {}
    /**
     * Dispatches the request to the Router class
     * 
     * @access public
     * @final
     */
    public final function run ()
    {
        try{
            JPL_Router::callControllerAction();
        }catch(Jpl_Exception_InvalidAction $e){
            $error = new ErrorController();
            $error->error($e);
        }catch(Jpl_Exception_InvalidController $e){
            $error = new ErrorController();
            $error->error($e);
        }
    }
}
?>
