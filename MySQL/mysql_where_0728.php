<?php

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());

echo '<p>Sikeresen csatlakoztunk az adatbázishoz!</p>';

// egy adott elem speciális lekérdezéséhez a WHERE kulcsszót használjuk a lekérdezésben
// azaz ezzel találjuk meg a kívánt elemet

$eredmeny = mysql_query("SELECT * FROM pelda WHERE `name` = 'Mekk Elek'") or die(mysql_error());
//figyeljünk itt a két különböző aposztróf használatára!
// a hibaüzenetek valami közelítő tippet adnak arra vonatkozóan, hogy merre lehet a hiba
// éles környezetben továbbra sem szabad benne hagyni hibaüzenetet!
// és a @ is szükséges abban az esetben
// 
// 
// 
// 
// gyűjtsük be az első, és remélhetőleg egyetlen találatot

$row = mysql_fetch_array($eredmeny);

//írassuk ki az eredményt

echo $row['name'].' - '.$row['age'].'<br/>';

// le szeretném kérdezni azokat a neveket, akiknek a kora 20-29 év

$eredmeny = mysql_query("SELECT * FROM pelda WHERE age LIKE '2%'") or die(mysql_error()); // a % jel helyettesíti a bármit


// gyűjtsük be a kapott eredményeket
// mivel tübb eredményre számítunk, jöhet a while
// más kérdés, hogy nálam csak egy ember esik bele ebbe a tartományba, így csak egy eredmény lesz

while($row = mysql_fetch_array($eredmeny)) { 
    echo $row['name'].' - '.$row['age'].'<br/>';
}