<?php

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());

//töltsük fel adatokkal
// ha új adatokat szeretnénk felvenni a db-be, akkor az lesz az INSERT lekérdező sql utasítás

/*
 * BESZÚRÁS SZINTAXISA
 * 
 * INSERT INTO `tablaneve`(`mezőnév1`, `mezőnév2`) VALUES (`mitillesztek1`, `mitillesztek2`)
 * 
 * `mezőnév1`, `mezőnév2` -> a hely, ahová be szeretnék illeszteni adatokat
 * 
 * `mitillesztek1`, `mitillesztek2` -> az értékeket jelöli, amit a 2 mezőbe be szeretnék tenni
 * 
 * FONTOS!! az értékek mindig '' operátorok között kerülnek felvitelre, ami nem elhagyható!
 * (a `` operátorok a mező- és a táblaneveket jelölik - php-ban elhagyhatók, 
 * de ha PHPMyAdminban SQL lekérdezést írok (vagy más SQL szerkesztőben teszem ezt), akkor ez is kötelező!
 */


mysql_query("INSERT INTO pelda(`name`, age) VALUES('Teszt Elek', '42')");
mysql_query("INSERT INTO pelda(`name`, age) VALUES('Mekk Elek', '21')");
mysql_query("INSERT INTO pelda(`name`, age) VALUES('Trab Antal', '15')");

echo '<h4>Adatok beillesztése sikeresen megtörtént.';
