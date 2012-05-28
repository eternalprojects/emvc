<?php

/**
 * URL View helper class
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
 * @package Jpl\View\Helper
 */
namespace Jpl\View\Helper;
use Jpl\Router;
use Jpl\Registry;

/**
 * The URL View Helper class
 *
 * This view helper is essentially used for generating links for
 * inside the application
 *
 * @package Jpl\Controller\Page
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.0
 *       
 */
class Url
{

    /**
     * The default constructor
     *
     * @deprecated          
     */
    function __construct ()
    {}

    /**
     * Creates a hyperlink url based on a Controller and action
     *
     * @param string $controller            
     * @param string $action            
     */
    static function createLinkUrl ($controller, $action)
    {
        echo Registry\Application::get('baseUrl') . '/' . $controller . '/' .
                 $action;
    }

    /**
     * Creates a hyperlink url based on a static file url
     *
     * @param string $url            
     */
    static function createStaticUrl ($url)
    {
        echo Registry\Application::get('baseUrl') . '/static/' . $url;
    }
}

?>