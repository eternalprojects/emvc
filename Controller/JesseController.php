<?php
require_once APPLICATION_PATH . '/Library/Jpl/Controller/Page.php';
class JesseController extends Jpl_Controller_Page
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
