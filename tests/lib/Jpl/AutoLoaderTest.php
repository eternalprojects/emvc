<?php

/**
 * Contains the AutoLoader Unit Test class
 *
 * License:
 *
 * Copyright (c) 2010, JPL Web Solutions,
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
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     v1.0
 * @link      http://www.eternalmvc.info
 *
 */
/**
 *
 * @package Jpl
 */
namespace Test\Jpl;
use \Jpl\AutoLoader as AL;

/**
 * A class to automate loading of class files
 *
 * This class contains a method used by SPL Register Autoloader function to
 * automatically load class files. It checks the first part of the class name
 * to determine whether to load from the library or load from the Model
 * directory
 *
 * @package Test\Jpl\AutoLoaderTest
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2012 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General
 *          Public License
 * @since v1.0
 * @link http://www.eternalmvc.info
 *      
 */
class AutoLoaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Method to test that autoloader fails
     *
     * This method tries to have the autoloader load a non-existant class. The
     * AL::AutoLoad method will return flase if the specified class could not
     * be loaded.
     *
     * @access public
     * @see \Jpl\AutoLoader::AutoLoad()
     * @since 1.0
     */
    public function testFailedAutoLoad ()
    {
        $this->assertFalse(AL::AutoLoad('Model\Tested'));
    }

    /**
     * Method to test successful autoload of class
     *
     * This methid checks to ensure that an existing class is autoloaded.
     *
     * @access public
     * @see \Jpl\AutoLoader::AutoLoad()
     * @since 1.0
     */
    public function testModelSuccess ()
    {
        $this->assertTrue(AL::AutoLoad('Model\Test'));
    }

    /**
     * Method to test successful autoload of JPL library class
     *
     * This method tests to ensure classes of the Jpl library are successfully
     * autoloaded
     *
     * @access public
     * @see \Jpl\AutoLoader::AutoLoad()
     * @since 1.0
     */
    public function testJplLibSuccess ()
    {
        $this->assertTrue(AL::AutoLoad('Jpl\Router'));
    }

    /**
     * Method to test successful autoloading of controller classes
     *
     * This method tests to ensure that Controller classes are successfully
     * autoloaded.
     *
     * @access public
     * @see \Jpl\AutoLoader::AutoLoad()
     * @since 1.1
     */
    public function testControllerSuccess ()
    {
        $this->assertTrue(AL::AutoLoad('Controller\Jesse'));
        $this->assertTrue(AL::AutoLoad('Controller\Error'));
    }
}