<?php

/* 
2) Írjunk egy PHP szkriptet ami 0 és 30 közötti számokat összead
 */

$sum = 0;

for ($i = 0; $i <= 30; $i++) {
    $sum += $i;
}

echo "Az összege a 0 és 30 közötti számoknak: $sum";

