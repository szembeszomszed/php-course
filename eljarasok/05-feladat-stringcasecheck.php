<?php

/* 
5) Írjunk egy fügvényt, ami megvizsgálja hogy egy string kisbetüs
 */

function isLowerCase($szoveg) {
    for ($i = 0; $i < strlen($szoveg); $i++) {
        if (ord($szoveg[$i]) >= ord('A') && ord($szoveg[$i]) <= ord('Z')) { // az ord() az ASCII-értéket dobja vissza
            return false; // ha bármelyik karakter beleesik a nagybetűs ASCII tartományba, akkor false-szal tér vissza a függvény
        }
    }
    return true; // alapból pedig (tehát ha a felső feltétel nem teljesül) adja is a true-t
}

echo '<pre>';
var_dump(isLowerCase('abcdefgh'));
echo '</pre>';
echo '<pre>';
var_dump(isLowerCase('ABCDEFGH'));
echo '</pre>';
echo '<pre>';
var_dump(isLowerCase('ABCdEfGH'));
echo '</pre>';

