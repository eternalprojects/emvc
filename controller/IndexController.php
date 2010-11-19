<?php

class IndexController extends Jpl_Controller_Front{
	public function indexAction(){
		$this->view->title = "test";
	}
	public function assertAction(){
		$this->view->title = "Tested";
	}
}

?>
