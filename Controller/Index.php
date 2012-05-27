<?php
namespace Controller;

class Index extends \Jpl\Controller\Page
{

    public function indexAction ()
    {
        $this->view->title = "Index View";
    }

    public function assertAction ()
    {
        $this->view->title = "Assert View";
    }
}
?>
