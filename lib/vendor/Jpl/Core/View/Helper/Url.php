<?php

/**
 * URL View helper class
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
 * @package    Jpl\Core\View
 * @author     Jesse Lesperance <jesse@jplesperance.me>
 * @copyright  2010-2012 JPL Web Solutions
 * @link      http://www.eternalmvc.info
 * @license    http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since      v1.0
 *
 */
/**
 *
 * @package Jpl\Core\View\Helper
 */
namespace Jpl\Core\View\Helper;
use Jpl\Core\Registry\Application;

/**
 * The URL View Helper class
 *
 * This view helper is essentially used for generating links for
 * inside the application
 *
 * @uses \Jpl\Core\Registry\Application
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
     * Creates a hyperlink url based on a Controller and action
     *
     * @param string $controller            
     * @param string $action  
     * @return string   
     * @static    
     * @since 1.0   
     */
    static function createLinkUrl ($controller, $action)
    {
        return Application::get('baseUrl') . '/' . $controller . '/' .
                 $action;
    }

    /**
     * Creates a hyperlink url based on a static file url
     *
     * @param string $url 
     * @static 
     * @return string      
     * @since 1.0    
     */
    static function createStaticUrl ($url)
    {
        return Application::get('baseUrl') . '/static/' . $url;
    }
}
