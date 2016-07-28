<?php
//Tömbök

$tomb = array(); //üres tömb létrehozása
var_dump($tomb);

//tömb létrehozása értékekkel, automatikus indexre/kulcsra
$tomb = array(15, TRUE, 'Hello Világ!', 6/7, rand(1, 10));
echo "<br/>";
var_dump($tomb);

$tomb[] = 'Valami'; // a tömb bővítése, a soron következő indexre
echo "<br/>";
var_dump($tomb);
echo "<br/>";

$tomb[100] = 'ez a 100. index/kulcs'; // a tömb bővítése, irányított indexre
var_dump($tomb); 
echo "<br/>";

$tomb[] = 'Új elem'; // itt ugye megint a soron következő indexre bővítjük, ami már a 101.
var_dump($tomb); 
echo "<br/>";

$tomb[400] = 1;
unset($tomb[400]); //tömb egy adott elemének törlése
var_dump($tomb);
echo "<br/>";

$tomb[] = 'Még újabb elem'; //az előző elem törlése ellenére a soron következő index megmaradt 401-nek!
var_dump($tomb);
echo "<br/>";

//Tömb létrehozása, illetve újradeklarálása

$tomb2 = []; //ugyanaz, mint $tomb2 = array();
var_dump($tomb2);
echo "<br/>";

$tomb2["fullname"] = "Rétsági Máté"; //asszociatív elembővítés
//nem számmal bővítem számra, hanem szöveggel szövegre
//a kulcs/index itt nem szám lesz, hanem ez a string
$tomb2["jelenlegidatum"] = date('Y-m-d H:i:s');
var_dump($tomb2);
echo "<br/>";

//Tög egy adott elemének kiíratása
echo "<h2>".$tomb2['fullname']."</h2>"; //ügyelni kell a ""-re
//az esetleges undefined index error arra utal, hogy az adott tömbnek nincs ilyen kulcsa létrehozva
echo "<br/>";
echo '<h4>'.$tomb2["jelenlegidatum"].'</h4>';
echo "<br/>";


// Tömb műveletek
$egyesitett = array_merge($tomb, $tomb2); //tömbök egyesítése
var_dump($egyesitett);
echo "<br/>";


sort($egyesitett); //érték szerint növekvő sorrendbe rendez
//belenyúl a változóba, és újrakulcsolja az értékeket (mintha ezt a merge is megtenné már amúgy)
var_dump($egyesitett);
echo "<br/>";

echo 'A tömb értékeinek a maximuma: '.max($egyesitett).'<br/>';
echo 'A tömb értékeinek a minimuma: '.min($egyesitett).'<br/>';
echo 'A tömb elemeinek száma: '.count($egyesitett).'<br/>';






