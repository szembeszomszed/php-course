<?php

// 1) Készítsünk PHP szkriptet ami egy sorban rendre megjeleníti 1-2-3-4-5-6-7-8-9-10 kötőjellel

for ($i = 1; $i <= 10; $i++) {
    if ($i < 10) {
        echo "$i-";
    } else {
        echo $i;
    }
}

echo '<br/>';
// 2) Írjunk egy PHP szkriptet ami 0 és 30 közötti számokat összead

$sum = 0;
for ($i = 0; $i <= 30; $i++) {
    $sum += $i;
    if ($i < 30) {
        echo "$i + ";
    } else {
        echo "$i = ";
    }
}

echo $sum;
echo '<br/>';

//3) Készítsünk egy szkriptet ami a következő mintát adja eredményül
//*
//* *
//* * *
//* * * *
//* * * * *

echo '<table>';

for ($row = 1; $row <= 5; $row++) {
    echo '<tr>';
    for ($column = $row; $column >= 1; $column--) {
        echo '<td>*</td>';
    }
    echo '</tr>';
}

echo '</table>';




//4) Készítsünk egy szkriptet ami a következő mintát adja eredményül
//*
//* *
//* * *
//* * * *
//* * * * *
//* * * * *
//* * * *
//* * *
//* *
//*


echo '<table>';

for ($row = 1; $row <= 5; $row++) {
    echo '<tr/>';
    for ($column = $row; $column >= 1; $column--) {
        echo '<td>*</td>';
    }
    echo '</tr>';
}

for ($row = 1; $row <= 5; $row++) {
    echo '<tr/>';
    for ($column = $row; $column <= 5; $column++) {
        echo '<td>*</td>';
    }
    echo '</tr>';
}

echo '</table>';

//5) Írjunk egy programot ciklussalm ami kiszámolja adott szám faktoriálisát (4 faktoriálisa pl.: 4*3*2*1=24)

echo '<br/>';

$szam = 5;
$faktorialis = 1;

for ($i = $szam; $i > 1; $i--) {
    $faktorialis *= $i;
}

echo $faktorialis;

echo '<br/>';

//6) Írjunk egy programot, amely visszaadja 2 szám összes 2 számból álló kombinációját
//   Output:
//	 00, 01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
//	 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49,
//	 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74,
//	 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99,


for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 10; $j++) {
        echo $i.$j.", ";
    }
}

//7) Írjunk egy programot, amely megszámolja az összes r betüt a ruander szövegben

echo '<br/>';

$szo = 'ruander';
$betu = 'r';
$darabszam = 0;

for ($i = 0; $i < strlen($szo); $i++) {
    if (substr($szo, $i, 1) == $betu) {
        $darabszam++;
    }
}

echo $darabszam;
echo '<br/>';
$darabszam = 0;

for ($i = 0; $i < strlen($szo); $i++) {
    if ($szo[$i] == $betu) {
        $darabszam++;
    }
}

echo $darabszam;


//8) Írjunk egy szkriptet ami 3px-es cellpaddinggal és 0pxes cellspacinggal visszaadja a szorzótáblát
//   Output:
//	1 * 1 = 1	1 * 2 = 2	1 * 3 = 3	1 * 4 = 4	1 * 5 = 5
//	2 * 1 = 2	2 * 2 = 4	2 * 3 = 6	2 * 4 = 8	2 * 5 = 10
//	3 * 1 = 3	3 * 2 = 6	3 * 3 = 9	3 * 4 = 12	3 * 5 = 15
//	4 * 1 = 4	4 * 2 = 8	4 * 3 = 12	4 * 4 = 16	4 * 5 = 20
//	5 * 1 = 5	5 * 2 = 10	5 * 3 = 15	5 * 4 = 20	5 * 5 = 25
//	6 * 1 = 6	6 * 2 = 12	6 * 3 = 18	6 * 4 = 24	6 * 5 = 30

echo '<br/>';
echo '<table>';

for ($i = 1; $i <= 6; $i++) {
    echo '<tr>';
    for ($j = 1; $j <= 5; $j++) {
        $result = $i * $j;
        echo '<td>'.$i.' * '.$j.' = '.$result.'</td>';
    }
    echo '</tr>';
}

echo '</table>';
echo '<br/>';

//9) Készítsünk sakktáblát 270pxes tábla szélességben 30pxes cellamagassággal

echo '<table border="1" width="270">';

for ($sor = 1; $sor <= 8; $sor++) {
    echo '<tr>';
    for ($oszlop = 1; $oszlop <= 8; $oszlop++) {
        $mezo = $sor + $oszlop;
        if ($mezo % 2 == 0) {
            echo '<td width="30" height="30" bgcolor="white"></td>';
        } else {
            echo '<td width="30" height="30" bgcolor="black"></td>';
        }
    }
    echo '</tr>';
}

echo '</table>';
echo '<br/>';


//10) Írjunk egy PHP szkriptet ami az alábbi táblázatot készíti el:
//	Output:

//	 1	2	3	4	5	6	7	8	9	10
//	 2	4	6	8	10	12	14	16	18	20
//	 3	6	9	12	15	18	21	24	27	30
//	 4	8	12	16	20	24	28	32	36	40
//	 5	10	15	20	25	30	35	40	45	50
//	 6	12	18	24	30	36	42	48	54	60
//	 7	14	21	28	35	42	49	56	63	70
//	 8	16	24	32	40	48	56	64	72	80
//	 9	18	27	36	45	54	63	72	81	90
//	 10	20	30	40	50	60	70	80	90	100

echo '<table>';
for ($sor = 1; $sor < 11; $sor++) {
    echo '<tr>';
    for ($oszlop = 1; $oszlop < 11; $oszlop++) {
        $szorzat = $sor * $oszlop;
        echo "<td>$szorzat</td>";
    }
    echo '</tr>';
}

echo '</table>';
echo '<br/>';

//11) Írjunk egy php szkriptet ami 1 töl 100 ig a 3 többszörösei mellé odaírja hogy "Zsír" Míg az 5 többszörösei mellé odaírja hogy "Király"
//    amik 5 és 3 többszörösei, azok mellé írja "ZsírKirály" szót

for ($i = 1; $i < 101; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo $i.' zsírkirály <br/>';
    } elseif ($i % 3 == 0) {
        echo $i.' zsír <br/>';
    } elseif ($i % 5 == 0) {
        echo $i.' király <br/>';
    } else {
        echo $i.'<br/>';
    }
}



