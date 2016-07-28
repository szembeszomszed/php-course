<?php

/*
11) Írjon egy PHP szkriptet ami megkeresi a különbségeket két szóban
    Szoveg1 : 'kosarlabda'
    Szoveg2 : 'kosarladda'
    Output: A különbségek az alábbi pozícióban 8: "b" és "d"
*/

$szoveg1 = "kosqrlabda";
$szoveg2 = "kosarladda";

$strlen = strlen($szoveg1);

for ($i = 1; $i < $strlen; $i++) {
    if ($szoveg1[$i] != $szoveg2[$i]) {
        $first = $szoveg1[$i];
        $second = $szoveg2[$i];
        echo 'A különbségek az alábbi pozícióban találhatók:  '.($i + 1).', mégpedig a "'.$first.'" és "'.$second.'" betűk formájában.<br/>';
    }
}