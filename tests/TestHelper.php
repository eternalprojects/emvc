<?php

define('APPLICATION_PATH', dirname(__FILE__) . '/..');

require_once APPLICATION_PATH . '/lib/Jpl/AutoLoader.php';

spl_autoload_register(array('\Jpl\AutoLoader', 'AutoLoad'));