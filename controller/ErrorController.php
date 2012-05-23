<?php

class ErrorController extends Jpl_Controller_Page
{
    public function errorAction ($msg)
    {
        $this->view->title = "404 - Document Not Found";
        $this->view->message = $msg;
    }
}