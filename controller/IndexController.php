<?php
require_once APPLICATION_PATH . '/lib/Jpl/Controller/Page.php';
class IndexController extends Jpl_Controller_Page
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
