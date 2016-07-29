<?php

/* 
2) Írjunk egy eljárást  hogy leellenőrizzük hogy a szám prím e vagy sem
   A primszám egy természetes szám, ami nagyobb mint 1 és kizáróan 1el és önmagával lehet osztani
 */

function isPrime ($num) {
    for ($i = 2; $i < $num; $i++) {
        if ($num % $i == 0) {
            return 0;
        } else {
            return 1;
        }
    }
}

echo '<br/>';
echo '<br/>';


function primVizsgalat($n) {
    for ($i = 2; $i < $n; $i++) { // az első olyan számtól (2) indítunk, ahol már gond lehet az osztással
        //és ugyanígy a $n - 1-ig haladunk, hogy ne kerüljön bele olyan, amivel biztos osztható
        
        if ($n % $i == 0) {
            return 0;
        }
    }
    return 1; // eljárásokban általában nem íratunk ki dolgokat, hanem
    // a visszatérési értéket állítjuk be, amit majd az eljáráson kívül lekezelünk
}

$szam = primVizsgalat(100);
if ($szam == 0) {
    echo "Ez a szám nem prím";
} else {
    echo "Ez a szám prím";
}



