<?php
namespace Test\Base;
define('APPLICATION_PATH', dirname(__FILE__) . '/../');
set_include_path(
        get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . 'lib/vendor/' .
                 PATH_SEPARATOR . APPLICATION_PATH . 'tests/' . PATH_SEPARATOR . APPLICATION_PATH);

require_once 'Jpl/Core/AutoLoader.php';

spl_autoload_register(array(
        '\Jpl\Core\AutoLoader',
        'AutoLoad'
));