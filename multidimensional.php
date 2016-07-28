<?php

$multiArray = array (
    array('karcsi', 'marcsi', 'lajcsi'),
    array(1, 2, 3),
    );

var_dump($multiArray);
echo '<br/>';
echo $multiArray[0][2]; // -> lajcsi
echo '<br/>';
//$multiArray[1] = 'elem'; //ez felülírja az 1. indexen lévő arrayt egy sima stringgel
//var_dump($multiArray);
//echo '<br/>';
//echo $multiArray[0]; // nem tudja kiírni, hiszen a 0. kulcson egy array van
//echo '<br/>';

//for ($i = 0; $i < count($multiArray); $i++) {
  //  for ($j = 0; $j < 4; $j++) {
    //    echo $multiArray[$i][$j];
    //}
//}

$myArray = [5, 6, 7];

for ($i = 0; $i < count($myArray); $i++) {
    echo $myArray[$i];
}

echo '<br/>';
$assocArray = array(
    'Ujpest' => 'Budapest',
    'Aston Villa' => 'Birmingham',
    'Real Madrid' => 'Madrid');

foreach ($assocArray as $team => $city) {
    echo $team.' is a team from '.$city.' <br/>';
}

echo '<br/>';
var_dump($assocArray['Ujpest']);
echo '<br/>';

$users = array(
    $user1 = array(
        'id' => 1,
        'lastName' => 'Kovacs',
        'firstName' => 'Lajcsi',
        'email' => 'lajcsi@kovacs.hu',
        ),
    $user2 = array(
        'id' => 2,
        'lastName' => 'Horvath',
        'firstName' => 'Sanyi',
        'email' => 'sanyi@horvath.hu',
        ),
    $user3 = array(
        'id' => 3,
        'lastName' => 'Szabo',
        'firstName' => 'Karcsi',
        'email' => 'karcsi@szabo.hu',
        ),
    );



for ($i = 0; $i < count($users); $i++) { 
    echo $i . "{<br>"; 
    foreach($users[$i] as $key => $value) { 
        echo $key . " : " . $value . "<br>";
    } 
        echo "}<br>";
}

for ($i = 0; $i < count($users); $i++) {
    foreach ($users[$i] as $key => $value) {
        if ($key == 'email') {
            echo $value ."<br/>";
        }
    }
}


foreach ($users as $index => $item) { 
    echo $index . "{<br>"; 
    foreach($item as $key => $value) { 
        echo $key . " : " . $value . "<br>";
    } echo "}<br>"; 
}

foreach ($users as $index => $user) {
    foreach ($user as $key => $value) {
        if ($index == 1) {
            echo "$key : $value <br/>";
        }
    }
}

echo '<br/>';

foreach ($users as $index => $user) {
    foreach ($user as $key => $value) {
        if ($value == 'Horvath') {
            foreach ($user as $key => $value) {
                echo "$key : $value <br/>";
            }            
        }
    }
}

/* itt van egy $keys változó is, de nem sok értelme van ebben a példában
$keys = array_keys($users);
var_dump($keys);
echo '<br/>';

for ($i = 0; $i < count($users); $i++) {
    echo $keys[$i] . "{<br/>";
    foreach ($users[$keys[$i]] as $key => $value) {
        echo $key . " : " . $value . "<br/>";
    }
    echo "}<br/>";
}
*/

