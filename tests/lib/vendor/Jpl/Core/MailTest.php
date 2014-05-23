<?php
namespace Test\Jpl\Core;

use \Jpl\Core\Mail;

class MailTest extends \PHPUnit_Framework_TestCase {
    private $_mail;

    public function setup ()
    {
        $this->_mail = new Mail();
    }

    public function testWrongType(){
        try{
            $mail = new Mail(123);
        }catch(\Jpl\Core\Exception $e){
            $this->assertEquals("Invalid mail type provided: '123'.  Only 'plain' and 'html' are supported", $e->getMessage());
        }
        $mail = null;
    }
    public function testPlainTypeNoParam(){
        $mail = new Mail();
        $this->assertEquals("plain", $mail->getType());
        $mail = null;
    }

    public function testPlainTypeExplicit(){
        $mail = new Mail('plain');
        $this->assertEquals("plain", $mail->getType());
        $mail = null;
    }
    public function testHtmlType(){
        $mail = new Mail('html');
        $this->assertEquals("html", $mail->getType());
        $mail = null;
    }

    public function testSetType(){
        $mail = new Mail();
        $this->assertEquals("plain", $mail->getType());
        $mail->setType('html');
        $this->assertEquals('html', $mail->getType());
        $mail = null;
    }

}
 