<?php

/* 
7) Írjunk egy programot, amely megszámolja az összes r betüt a ruander szövegben
 */

$szoveg = "ruander";
$keresettBetu = "r";
$darabszam = 0;

for ($i = 0; $i < strlen($szoveg); $i++) {
    if (substr($szoveg, $i, 1) == $keresettBetu) { //mivel az $i végigmegy a stringen, így a második paraméternek, vagyis a szöveg startjának jól jön az $i, a hosszra pedig az 1-est állítjuk be, így a szöveg végéig fog ellenőrizni
        $darabszam++;       
    }
}

echo "A szövegben összesen $darabszam alkalommal fordul elő a keresett \"$keresettBetu\" betű.";

