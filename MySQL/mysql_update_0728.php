<?php

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());


// egy adott rekord értékét az UPDATE utasítás segítségével tehetjük meg

// módosítsuk Mekk Elek korát 21-ről 22-re
// itt most minden 21 éves ember korát megváltoztatjuk
$result = mysql_query("UPDATE pelda SET age='22' WHERE age='21'") or die(mysql_error());

// FONTOS!! 
// új adatnál INSERT
// meglévő adat megváltoztatásánál, frissítésénél UPDATE

// itt most minden 21 éves ember korát megváltoztatjuk


// kérdezzük le az adatbázisból a 22 éves kort

$result = mysql_query("SELECT * FROM pelda WHERE age='22'") or die(mysql_error());

// jelenítsük meg a vélhetően egyetlen találatot (szóval nem while-ozunk most)

$row = mysql_fetch_array($result);

echo $row['name'].' - '.$row['age'];
