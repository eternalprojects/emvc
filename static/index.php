<?php
namespace Base;
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', true);

// Define path to application directory
defined('APPLICATION_PATH') ||
         define('APPLICATION_PATH', realpath(dirname(__FILE__)) . '/../');
set_include_path(
        get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . 'lib/vendor/' .
                 PATH_SEPARATOR . APPLICATION_PATH
);

require_once 'Jpl/Core/AutoLoader.php';
spl_autoload_register(
    array(
        '\Jpl\Core\AutoLoader',
        'AutoLoad'
    )
);

\Jpl\Core\Controller\Front::run();