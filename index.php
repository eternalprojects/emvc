<?php
// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__)));

set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . '/lib/');

require_once 'Jpl/AutoLoader.php';
spl_autoload_register(array('Jpl_AutoLoader','autoLoad'));

$baseUrl = 'http://localhost';

$frontController = new Jpl_Controller_Front();

$frontController->run();

?>