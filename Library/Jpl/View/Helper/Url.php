<?php
class Jpl_View_Helper_Url
{
    function __construct (Jpl_Router $router)
    {
        
    }
    // Creates a hyperlink url based on a Controller and action
    static function createLinkUrl ($controller, $action)
    {
        echo Jpl_Registry_Application::get('baseUrl') . '/' . $controller . '/' . $action;
    }
    // Creates a hyperlink url based on a static file url
    static function createStaticUrl ($url)
    {
        echo Jpl_Registry_Application::get('baseUrl') . '/static/' . $url;
    }
}
?>