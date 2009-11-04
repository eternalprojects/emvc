<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApplicationHelper
 *
 * @author lesperancej
 */
class ApplicationHelper {
    private static $_instance;
    private function __construct(){

    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function init(){
        $dsn = ApplicationRegistry::getDSN();
        if(!is_null($dsn)){
            return;
        }
        $this->_getOptions();
    }

    private function _getOptions(){
        $this->_ensure(file_exists($this->config), "Could not find options file");
        $options = simplexml_load_file($this->config);
        $this->_ensure($options instanceof SimpleXMLElement, "Could not resolve o[ptions file");
        $dsn = (string)$options->dsn;
        $this->_ensure($dsn, "No DSN Found");
        ApplicationRegistry::setDSN($dsn);
    }

    private function _ensure($expr, $message){
        if(!$expr)
            throw new AppException($message);
    }
}
?>
