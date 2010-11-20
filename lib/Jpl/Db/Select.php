<?php
/**
 * Contains the Select database abstraction class
 * 
 * License: http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
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
 * This class allows the creation of Select queries progmatically
 * 
 * @package Database
 * @subpackage Select
 * @author jesse Lesperance <jesse@jlesperance.com>
 *
 */
class Jpl_Db_Select
{
    /**
     * The columns that vaues should be retrieved from
     * 
     * @var array
     * @access protected
     */
    protected $_columns = array();
    /**
     * The table to select from
     * 
     * @var string
     * @access protected
     */
    protected $_from;
    /**
     * The first where clause of the query
     * 
     * @var string
     * @access protected
     */
    protected $_where;
    /**
     * 
     * @var array
     * @access protected
     */
    protected $_andWhere = array();
    /**
     * 
     * @var array
     * @access protected
     */
    protected $_orWhere = array();
    /**
     * The default constructor function
     * 
     * The constructor checks to see that a set of columns were passed as an 
     * array and adds them to a class memeber
     * 
     * @param array $columns
     * @access public
     */
    public function __construct (array $columns = null)
    {
        if (! columns == null && is_array($columns)) {
            $this->_columns = $columns;
        }
    }
    /**
     * retrieve the list of columns
     * 
     * @access public
     * @return array
     */
    public function getColumns ()
    {
        return $this->_columns;
    }
    /**
     * set the table to issue the query on
     * 
     * @param string $from
     * @access public
     */
    public function from ($from)
    {
        $this->_from = $from;
    }
    /**
     * retrieve the table for the query
     * 
     * @access public
     * @return string
     */
    public function getFrom ()
    {
        return $this->_from;
    }
    /**
     * Set the where clause
     * 
     * @access public
     */
    public function where ()
    {}
}
?>