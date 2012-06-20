<?php
namespace Controller;

class Error extends \Jpl\Core\Controller\Page
{

    public function errorAction ($msg)
    {
        $this->view->title = "404 - Document Not Found";
        $this->view->message = $msg;
    }
}