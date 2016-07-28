<?php

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());

echo '<h2>Sikeresen csatlakoztunk az adatbázishoz!</h2>';


//lekérdezek mindent

$eredmeny = mysql_query("SELECT * FROM pelda") or die(mysql_error());


// tömbbe rendezem a lekérdezett adatokat - így tárolom őket
// a mysql_fetch_array() segít ebben

$row = mysql_fetch_array($eredmeny); // ebben a formában csak az első sort tárolná el

//echo '<pre>';
//var_dump($row); 
//echo '</pre>';

// írassuk ki szépen az eredményt

echo "Név: ".$row['name'].'<br/>';
echo "Kora: ".$row['age'].'<br/>';


