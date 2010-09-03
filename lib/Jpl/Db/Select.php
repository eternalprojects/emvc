<?php
/**
 * Contains the Select database abstraction class
 * 
 * License: http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * 
 * Copyright (c) 2010, JPL Web Solutions, 
 *                     Jesse Lesperance <jesse@jplesperance.com>
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
 * @category Library
 * @package Database
 * @subpackage Select
 * @author Jesse Lesperance <jesse@jplesperance.com>
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
 * @author jesse Lesperance <jesse@jplesperance.com>
 *
 */
class Jpl_Db_Select {
	/**
	 * The columns that vaues should be retrieved from
	 * 
	 * @var array
	 */
	protected $_columns = array();
	/**
	 * The table to select from
	 * 
	 * @var string
	 */
	protected $_from;
	/**
	 * The first where clause of the query
	 * 
	 * @var string
	 */
	protected $_where;
	/**
	 * 
	 * @var unknown_type
	 */
	protected $_andWhere = array();
	/**
	 * 
	 * @var unknown_type
	 */
	protected $_orWhere = array();
	/**
	 * 
	 * @param unknown_type $columns
	 */
	public function __construct($columns = null){
		if(!columns == null && is_array($columns)){
			$this->_columns = $columns;
		}
	}
	/**
	 * 
	 */
	public function getColumns(){
		return $this->_columns;
	}
	/**
	 * 
	 * @param unknown_type $from
	 */
	public function from($from){
		$this->_from = $from;
	}
	/**
	 * 
	 */
	public function getFrom(){
		return $this->_from;
	}
	/**
	 * 
	 */
	public function where(){
		
	}
}

?>