<?php
/**
 * Contains the Page Controller
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
require_once APPLICATION_PATH . '/lib/Jpl/View.php';
require_once APPLICATION_PATH . '/controllers/ErrorController.php';
/**
 * The Page Controller Abstract class
 * 
 * The Page Controller class is abstract and all user defined applications must 
 * extend it.  The page controller handles initiating the View object and 
 * rendering the view after processing the controller and action
 * 
 * @package MVC-Core
 * @subpackage Controller
 * @author jesse Lesperance <jesse@jlesperance.com>
 * @abstract
 *
 */
abstract class Jpl_Controller_Page
{
    /**
     * contains reference of Jpl_View
     * 
     * @var $view Jpl_View
     * @access protected
     */
    protected $view;
    /**
     * contains the controller and action names
     * 
     * @var $_route array
     * @access private
     */
    private $_route;
    /**
     * The default constructor
     * 
     * The constructor assings the $route array to a class member.  It also 
     * instantiates the Jpl_View class and keeps the reference in a class member.
     * 
     * @param array $route
     * @access public
     */
    public function __construct (array $route)
    {
        $this->_route = $route;
        $this->view = new Jpl_View();
    }
    /**
     * The class dustructor
     * 
     * The destructor calls the render method of the Jpl_View class which 
     * renders the appropriate view
     * 
     * @access public
     */
    public function __destruct ()
    {
        $this->view->render($this->_route);
    }
}
