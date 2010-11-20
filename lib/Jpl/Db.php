<?php
/**
 * Contains the Database Wrapper class
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
 * @subpackage Database
 * @author Jesse Lesperance <jesse@jlesperance.com>
 * @copyright 2010 JPL Web Solutions
 * @license http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @version SVN: $Id$
 *
 */
/**
 * A class to allow database access progmatically
 * 
 * This class implements the Active Record Pattern but is also a Singleton.  
 * This allows using objects to create SQL queries, and returns the result 
 * set from the database.
 * 
 * @package MVC-Core
 * @subpackage Database
 * @author jesse Lesperance <jesse@jlesperance.com>
 *
 */
class Jpl_Db
{
    /**
     * Reference to PDO
     * 
     * @var object contains reference to PDO object
     * @access private
     */
    private $_db = null;
    /**
     * Contains instance of self
     * 
     * @var Jpl_Db An instance of itself
     * @staticvar
     * @access private
     */
    private static $_instance;
    /**
     * The default constructor
     * 
     * The constructor takes an array of the connection settings and initiates 
     * a connection to the database using PDO
     * 
     * @param array $p
     * @access private
     */
    private function __construct (array $p)
    {
        $this->_db = new PDO('mysql:host=' . $p['host'] . ';dbname=' . $p['dbname'], $p['username'], $p['password']);
    }
    /**
     * static function that checks for exisitince of self
     * 
     * The init function checks to see if the Jpl_Db class has already been 
     * instantiated.  If it has, the existing reference of the class is returned.  
     * Otherwise, a reference is created and then returned.
     * 
     * @param array $params
     * @static
     * @access public
     * @return Jpl_Db
     */
    public static function init (array $params)
    {
        if (self::$_instance == null) {
            self::$_instance = new self($params);
        }
        return self::$_instance;
    }
    /**
     * Gateway to the select object
     * 
     * @param array $columns
     * @uses Jpl_Db_Select
     * @access public
     * @return Jpl_Db_Select
     */
    public function select (array $columns = null)
    {
        require_once 'Jpl/Db/Select.php';
        $select = new Jpl_Db_Select($columns);
        return $select;
    }
    /**
     * Fetch all matching rows
     * 
     * @param Jpl_Db_Select $select
     * @return Array
     * @access public
     */
    public function fetchAll (Jpl_Db_Select $select)
    {
        $result = $this->_db->fetchAll(PDO_FETCH_MODE::ASSOC);
        return $result;
    }
    /**
     * Generate the query
     * 
     * @param Jpl_Db_Select $select
     * @access private
     */
    private function generateQuery (Jpl_Db_Select $select)
    {}
}
?>