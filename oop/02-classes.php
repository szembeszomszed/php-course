<?php

class Person
{

    // define class properties
    public $name;
    public $age;

    // define a class method
    public function sentence()
    {
        return $this->name. ' is '.$this->age.' years old.';
    }
}

// create a new instance of the Person class
// which is going to be an object
$person1 = new Person();

// assign values to its properties
$person1->name = 'John';
$person1->age = '20';

echo $person1->sentence();

