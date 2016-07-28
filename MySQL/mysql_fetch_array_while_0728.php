<?php

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());

echo '<p>Sikeresen csatlakoztunk az adatbázishoz!</p>';

//lekérdezek mindent

$eredmeny = mysql_query("SELECT * FROM pelda") or die(mysql_error());

echo '<p>Sikeres lekérdezés!</p>';

// a fetch lényege tehát, hogy begyűjti a lekérdezés során megkaparintott sorokat

echo '<table border="1">';
echo '<tr><th>Név</th><th>Kor</th></tr>';

while ($row = mysql_fetch_array($eredmeny)) { // a fetch_array() begyűjti a sorokat, aztán amikor a végére ér, már üres sort dob ki - egyébként while nélkül is lépeget a sorok közt a fetch_array(), csak akkor újra meg újra be kéne írni
    // tehát a while segít abban, hogy amíg a fetch_array() kap találatot, addig pörgesse
    // amint már nincs találat, kilépünk a ciklusból
    echo '<tr><td>';
    echo $row['name'];
    echo '</td>';
    echo '<td>';
    echo $row['age'];
    echo '</td></tr>';
}

echo '<table>';


/*

// hasonlítsuk össze a fetch mysql függvényeket!


$row = mysql_fetch_array($eredmeny);
echo '<br/>';
echo '<pre>';
var_dump($row);
echo '</pre>';
 
 



$row = mysql_fetch_assoc($eredmeny); // csak assoc kulcsra gyűjt
echo '<br/>';
echo '<pre>';
var_dump($row);
echo '</pre>';




$row = mysql_fetch_object($eredmeny); // assoc kulcsra gyűjt, talán Classba?
echo '<br/>';
echo '<pre>';
var_dump($row);
echo '</pre>';




$row = mysql_fetch_row($eredmeny); // csak automatikus indexre gyűjti ki az értékeket
echo '<br/>';
echo '<pre>';
var_dump($row);
echo '</pre>';

*/
