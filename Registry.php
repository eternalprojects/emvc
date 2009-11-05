<?php
/**
 * The Global Regtistry Class File
 *
 * @author Jesse Lesperance
 * @copyright 2009 - JPL Web Innovations
 * @filesource
 * @package MVC
 */
/**
 * The Registry Class
 *
 * This class will store values on the class so that they me be accessed else
 * where in the app without implementing the bad practice of using Global
 * Variables
 *
 * @subpackage Registry
 */
abstract class Registry{
  	abstract protected function set($name, $value);
  	abstract protected function get($name);
}