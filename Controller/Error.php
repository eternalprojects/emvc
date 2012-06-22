<?php
namespace Controller;

class Error extends \Jpl\Core\Controller\Page
{

    public function errorAction ($msg)
    {
        $this->_view->title = "404 - Document Not Found";
        $this->_view->message = $msg;
    }
}