<?php

/* 
1) Készítsünk PHP szkriptet ami egy sorban rendre megjeleníti 1-2-3-4-5-6-7-8-9-10 kötőjellel
 */

for ($i = 1; $i <= 10; $i++) {
    /*
    if ($i == 10) {
        echo $i;
    } else {
        echo "$i-";
    }
    */
    
    echo ($i < 10) ? "$i-" : $i; //short if-fel
}



