<?php

abstract class Jpl_Controller_Page{
	protected $view;
	private $_route;

	public function __construct($route){
		$this->_route = $route;
		$this->view = new Jpl_View();
	}
	
	public function __destruct(){
		$this->view->render($this->_route);
	}
		
}
