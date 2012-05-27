<?php

define('APPLICATION_PATH', dirname(__FILE__) . '/..');
set_include_path(
get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . '/Library/' .
PATH_SEPARATOR . APPLICATION_PATH);

require_once APPLICATION_PATH . '/Library/Jpl/AutoLoader.php';

spl_autoload_register(array(
        '\Jpl\AutoLoader',
        'AutoLoad'
));