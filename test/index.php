<?php 

class MyObject {

    public $name = 'JJ';
    public $age = 38;
  
    public function __toString() {
      return "My name is: {$this->name}<br>\n";
    }
  
  }
  
  $obj = new MyObject;

  $age = (string)$obj->age;

  var_dump($age);
















?>