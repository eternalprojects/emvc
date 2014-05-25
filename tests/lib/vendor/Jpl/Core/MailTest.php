<?php
namespace Test\Jpl\Core;


class MailTest extends \PHPUnit_Framework_TestCase {
    private $_mail;

    public function setup ()
    {
        parent::setup();
    }

    public function testWrongType(){
        try{
            $mail = new \Jpl\Core\Mail(123);
        }catch(\Jpl\Core\Exception $e){
            $this->assertEquals("Invalid mail type provided: '123'.  Only 'plain' and 'html' are supported", $e->getMessage());
        }
        $mail = null;
    }
    public function testPlainTypeNoParam(){
        $mail = new \Jpl\Core\Mail();
        $this->assertEquals("plain", $mail->getType());
        $mail = null;
    }

    public function testPlainTypeExplicit(){
        $mail = new \Jpl\Core\Mail('plain');
        $this->assertEquals("plain", $mail->getType());
        $mail = null;
    }
    public function testHtmlType(){
        $mail = new \Jpl\Core\Mail('html');
        $this->assertEquals("html", $mail->getType());
        $mail = null;
    }

    public function testSetType(){
        $mail = new \Jpl\Core\Mail();
        $this->assertEquals("plain", $mail->getType());
        $mail->setType('html');
        $this->assertEquals('html', $mail->getType());
        $mail = null;
    }

}
 