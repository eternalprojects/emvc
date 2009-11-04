<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author lesperancej
 */
class Controller {
    private $_applicationHelper;

    private function __construct(){

    }

    static function run(){
        $instance = new self();
        $instance->_init();
        $instance->_handleRequest();
    }

    protected function _init(){
        $this->_applicationHelper = ApplicationHelper::getInstance();
        $this->_applicationHelper->init();
    }

    protected function _handleRequest(){
        $request = new Request();
        $cmd_r = new CommandResolver();
        $cmd - $cmd_r->getCommand($request);
        $cmd->execute($request);
    }
}
?>
