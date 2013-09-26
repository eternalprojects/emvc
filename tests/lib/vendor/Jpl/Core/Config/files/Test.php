<?php
namespace Test\Jpl\Core\Config\Data;

class Test
{
    protected $testvar;
    
    public function getTestVar(){
        return $this->testvar;
    }
    
    public function setTestVar($data){
        $this->testvar = $data;
    }
}

?>