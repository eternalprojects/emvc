<?php
namespace Controller;

class Index extends \Jpl\Core\Controller\Page
{

    public function indexAction ()
    {
        $this->_view->title = "Index View";
    }

    public function assertAction ()
    {
        $this->_view->title = "Assert View";
    }
}