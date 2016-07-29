<?php

/* 
14) Írjunk egy PHP szkriptet ami megmutatja a forráskódját a http://example.com weboldalnak
 */

$osszesSor = file('http://example.com'); // a file() útvonalat vár, így egy oldal útvonalát is megadhatjuk neki,
// és akkor a forráskód tud megjelenni

/*
echo "<pre>";
var_dump($osszesSor);
echo "</pre>";
 */

foreach ($osszesSor as $sorszam => $ertek) {
    echo $sorszam.' sorszám: '.htmlspecialchars($ertek).'<br/>';
    //a htmlspecialchars() kijelzi a használt html-karaktereket, tehát formzázás nélkül fogjuk látni a kódot
}

