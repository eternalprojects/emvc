<?php

/**
 * Contains the Page Controller class
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
 * @package    Jpl\Core\Controller
 * @author     Jesse Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2012 JPL Web Solutions
 * @link      http://www.eternalmvc.info
 * @license    http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since      v1.0
 *
 */
/**
 *
 * @package Jpl\Core\Controller
 */
namespace Jpl\Core\Controller;
use \Jpl\Core\View;
require_once APPLICATION_PATH . '/Controller/Error.php';

/**
 * The Page Controller Abstract class
 *
 * The Page Controller class is abstract and all user defined applications must
 * extend it. The page Controller handles initiating the View object and
 * rendering the view after processing the Controller and action
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.0
 * @abstract
 *
 *
 */
abstract class Page
{

    /**
     * contains reference of \Jpl\Core\View
     *
     * @var $view Jpl\Core\View
     * @see \Jpl\Core\View;
     * @access protected
     */
    protected $view;

    /**
     * contains the Controller and action names
     *
     * @var $_route array
     * @access protected
     */
    protected $_route;

    /**
     * The default constructor
     *
     * The constructor assings the $route array to a class member. It also
     * instantiates the Jpl_View class and keeps the reference in a class
     * member.
     *
     * @param array $route            
     * @access public
     */
    public function __construct (array $route)
    {
        $this->_route = $route;
        $this->view = new View();
    }

    /**
     * Set the route
     *
     * @param array $route            
     */
    public function setRoute (array $route)
    {
        $this->_route = $route;
    }

    /**
     * Get the currently ser route
     *
     * @return array
     */
    public function getRoute ()
    {
        return $this->_route;
    }

    /**
     * Set the View class to use
     *
     * @param \JPL\Core\View $view            
     */
    public function setView (\JPL\Core\View $view)
    {
        $this->view = $view;
    }

    /**
     * Retrieve the View class
     *
     * @return \Jpl\Core\View
     */
    public function getView ()
    {
        return $this->view;
    }

    /**
     * The class dustructor
     *
     * The destructor calls the render method of the Jpl_View class which
     * renders the appropriate view
     *
     * @access public
     * @throws \Exception
     */
    public function __destruct ()
    {
        try {
            $this->view->render($this->_route);
        } catch (\Exception $e) {
            $error = new \Controller\Error(
                    array('error', 'error')
                );
            $error->errorAction($e->getMessage());
        }
    }
}
