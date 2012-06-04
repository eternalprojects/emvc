<?php
namespace Base;
error_reporting(E_ALL);
ini_set('display_errors', true);

// Define path to application directory
defined('APPLICATION_PATH') ||
         define('APPLICATION_PATH', realpath(dirname(__FILE__)));
set_include_path(
        get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . '/Library/' .
                 PATH_SEPARATOR . APPLICATION_PATH
);

require_once 'Jpl/AutoLoader.php';
spl_autoload_register(
    array(
        '\Jpl\AutoLoader',
        'AutoLoad'
    )
);
/**
 * @todo Fix This
 */
$baseUrl = "http://jessedev/mvc/trunk/";

\Jpl\Controller\Front::run();