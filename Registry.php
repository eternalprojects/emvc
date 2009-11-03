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
class Registry{
    /**
     * This an instance of the Registry class
     *
     * @staticvar Object
     * @access Private
     */
    private static $_instance;
    /**
     * Holds all the values sent to the registry class
     *
     * @access Private
     * @var array
     */
    private $_elements = array();
    /**
     * The construct method - not implemented
     *
     * @access Private
     * @final
     */
    private final function __construct(){

    }
    /**
     * Check to see if an instance of the class already exists, if not create
     * one.  Return the instance of the class
     *
     * @access Public
     * @final
     * @return Object
     */
    public final static function getInstance(){
        // Check to see if an instance of the class already exists
        if(!isset(self::$_instance))
            // If not, create an instance of the class
            self::$_instance = new self();
        // Return the instance of the class
        return self::$_instance;
    }
    /**
     * Set the name and value pair to the Registry
     *
     * @access Public
     * @final
     * @param string $name
     * @param mixed $value
     */
    public final function setValue($name, $value){
        $this->_elements[$name] = $value;
    }
    /**
     * Retrieve the value to a specific name
     *
     * @access Public
     * @final
     * @param string $name
     * @return mixed
     */
    public final function getValue($name){
        return $this->_elements[$name];
    }
    /**
     * Get all the name-value pairs set in the Registry
     *
     * @access Public
     * @final
     * @return array
     */
    public final function getAll(){
        return $this->_elements;
    }
}