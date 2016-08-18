<?php

class Person
{

    // define class properties
    public $name;
    public $age;

    // create a construct method
    // this is automatically called when an instance of the class is created
    // we can also pass arguments to it
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    // define a class method
    public function sentence()
    {
        return $this->name. ' is '.$this->age.' years old.';
    }
}

// create a new instance of the Person class
// which is going to be an object
// now we pass the values as arguments to the class instance being created
$person1 = new Person("John", 20);

echo $person1->sentence();