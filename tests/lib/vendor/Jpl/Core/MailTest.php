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
        }catch(\Jpl\Exception $e){
            $this->assertEquals("Invalid mail type provided: '123'.  Only 'plain' and 'html' are supported")
        }
    }


}
 