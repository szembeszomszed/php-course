<?php

// create a new instance of stdClass
$object1 = new stdClass;

// assign a property (name) to this class
// a property is basically a variable
$object1->name = 'Clayton';

echo $object1->name;
echo '<br/>';

$object2 = new stdClass();

// the property can be an array, too
$object2->names = ['John', 'Susan', 'Bobby'];

foreach ($object2->names as $name) {
    echo $name .'<br/>';
}