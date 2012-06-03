<?php
namespace Controller;

class Jesse extends \Jpl\Controller\Page
{

    public function indexAction ()
    {
        $this->view->title = "Index View";
    }

    public function assertAction ()
    {
        $this->view->title = "Assert View";
    }

    public function rocksAction ()
    {
        $this->view->title = "Jesse Rocks!!";
    }
}
?>
