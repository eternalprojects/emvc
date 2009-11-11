<?php

set_include_path(get_include_path() . PATH_SEPARATOR . 'lib/');

require_once 'Jpl/AutoLoader.php';
spl_autoload_register(array('Jpl_AutoLoader','autoLoad'));


require_once './lib/simplemvcwf/route.php';
require_once './model/dbconfig.php';
require_once './controller/about_controller.php';
require_once './controller/article_controller.php';
require_once './controller/home_controller.php';

$baseUrl = 'http://localhost';

$router = new Jpl_Router();

$router->registerRoute(new Jpl_Route('about/index', 'about', 'index'));
$router->registerRoute(new Jpl_Route('about', 'about', 'index'));

$router->registerRoute(new Jpl_Route('article/index', 'article', 'index'));
$router->registerRoute(new Jpl_Route('article/view', 'article', 'view'));
$router->registerRoute(new Jpl_Route('article/addsubmit', 'article', 'addsubmit'));
$router->registerRoute(new Jpl_Route('article/add', 'article', 'add'));
$router->registerRoute(new Jpl_Route('article', 'article', 'index'));

$router->registerRoute(new Jpl_Route('home/index', 'home', 'index'));
$router->registerRoute(new Jpl_Route('home', 'home', 'index'));
$router->registerRoute(new Jpl_Route('', 'home', 'index'));

$router->callControllerAction();
?>