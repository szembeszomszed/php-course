<?php

//a lekérdező műveleteknél először csatlakozunk a MySQL-hez és az adatbázishoz

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());

// a tábla létrehozása az adatbázisban egy SQL lekérdező művelet
// a lekérdezéseket mysql_query() függvénybe írjuk
// a táblalétrehozó lekérdezés neve az SQL-ben a CREATE TABLE
// 
// 
//szintaxisa:

/*
 * CREATE TABLE `táblaneve` (
 *      `mezőnév` típus lehet_e_null_értékű növeljük_e_automatikusan_az_értékét (pl id esetén),
 *      `mezőnév2` típus lehet_e_null_értékű növeljük_e_automatikusan_az_értékét (pl id esetén),
 *      PRIMARY KEY (elsődleges kulcsú mező neve) (olyan legyen ez, ami biztos ki van töltve),
 *      `mezőnév3` típus stb.
 */

mysql_query("CREATE TABLE pelda(" //php-ban nem kötelező a `` jelet használni!
        . "id INT NOT NULL AUTO_INCREMENT,"
        . "PRIMARY KEY(id),"
        . "name VARCHAR(30)," //megadom, hogy hány karakter férhet bele
        . "age INT)") or die(my_sql_error());

echo '<h3>Tábla sikeresen létrehozva</h3>';
