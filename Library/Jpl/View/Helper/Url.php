<?php
namespace Jpl\View\Helper;
use Jpl\Router;

class Url
{
    function __construct(Router $router)
    {

    }

    // Creates a hyperlink url based on a Controller and action
    static function createLinkUrl($controller, $action)
    {
        echo \Jpl_Registry_Application::get('baseUrl') . '/' . $controller . '/' . $action;
    }

    // Creates a hyperlink url based on a static file url
    static function createStaticUrl($url)
    {
        echo \Jpl_Registry_Application::get('baseUrl') . '/static/' . $url;
    }
}

?>