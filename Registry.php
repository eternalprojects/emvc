<?php
/**
 * The Global Regtistry Class File
 *
 * @author Jesse Lesperance
 * @copyright 2009 - JPL Web Innovations
 * @filesource
 * @package MVC
 * @version 1.0
 */
/**
 * The Registry Class
 *
 * This class will store values on the class so that they me be accessed else
 * where in the app without implementing the bad practice of using Global
 * Variables
 *
 * @author Jesse Lesperance
 * @subpackage Registry
 * @abstract
 */
abstract class Registry{
	/**
	 * This is an abstract setter method to be overloaded in sub-classes
	 *
	 * @abstract
	 * @access Protected
	 * @param string $name
	 * @param mixed $value
	 */
  	abstract protected function set($name, $value);
  	/**
  	 * This is an abstract getter method to be over-loaded in sub-classes
  	 *
  	 * @abstract
  	 * @access Protected
  	 * @param string $name
  	 */
  	abstract protected function get($name);
}