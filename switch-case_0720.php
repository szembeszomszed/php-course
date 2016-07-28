<?php

$kedvencSzin = 'zöld';

switch ($kedvencSzin) {
    case "piros" :
        echo 'a kedvenc színem a piros';
        break;
    case "zöld" :
        echo 'a kedvenc színem a zöld';
        break;
    case "rózsaszín" :
        echo 'a kedvenc színem a rózsaszín';
        break;
    default : 
        echo 'nincs kedvenc színem';
        //a break itt már nem kötelező
}

//a switch case-t egyszerűbb elágazásokra használjuk
//pl menüpontoknál hasznos

