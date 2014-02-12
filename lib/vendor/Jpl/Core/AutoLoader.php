<?php
/**
 * Contains the AutoLoader class
 *
 * License:
 *
 * Copyright (c) 2010-2014, JPL Web Solutions,
 * Jesse P Lesperance <jesse@jplesperance.me>
 *
 * This file is part of EternalMVC.
 *
 * EternalMVC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.  JPL-MVC is distributed in the hope
 * that it will be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * See the GNU General Public License for more details. You should have
 * received a copy of the GNU General Public License along with EternalMVC.
 *
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2014 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     v1.0
 * @link      http://www.eternalmvc.info
 *            http://www.eternalprojects.com
 *            http://www.jplesperance.me
 * @package   Jpl\Core\AutoLoader
 */
/**
 *
 * @package Jpl\Core\AutoLoader
 */
namespace Jpl\Core;

/**
 * A class to automate loading of class files
 *
 * This class contains a method used by SPL Register Autoloader function to
 * automatically load class files. It checks the first part of the class name
 * to determine whether to load from the library or load from the Model
 * directory
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2014 JPL Web Solutions
 * @since v1.0
 *      
 */
class AutoLoader
{

    /**
     * The method for autoloading classes
     *
     * This function takes the class name specified an makes it an array. It
     * checks to see if the class name begins with 'Model' which determines the
     * path it loads from.
     *
     * The format it expects the class name to be namespaces with PHP 5.3 namespace feature.
     * The folder structure in the lib vendor folder should match the namespace of the class.
     *
     * This method is for use by the spl_register_autoloader function. Example:
     * <code>
     * spl_register_autoloader(array('Jpl\Core\AutoLoader','AutoLoad'));
     * </code>
     *
     * @param string $class the name of the class
     * @return boolean true if the file was able to be included
     * @api
     *
     */
    public static function AutoLoad ($class)
    {
        $class = str_replace('\\', '/', $class);
        $possibilities = array(
                APPLICATION_PATH . '/lib/vendor/' . DIRECTORY_SEPARATOR . $class .
                         '.php',
                        APPLICATION_PATH . DIRECTORY_SEPARATOR . $class . '.php'
        );
        foreach ($possibilities as $file) {
            if (file_exists($file)) {
                require_once ($file);
                return true;
            }
        }
        return false;
    }
}
