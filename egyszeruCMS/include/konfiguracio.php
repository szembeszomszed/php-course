<?php

// ez egy igen fontos fájl, ezért le kell védeni igényesen

// az ob_start() megakadályozza, hogy az ebben a fájlban lévő adatok elhagyják a php Apache-szervert
// azaz nem juthatnak kívülre az adatok illetéktelen kezekbe
// általában csak konfig-fájlokban szokás ezt megtenni
ob_start(); 

// munkamenet indítása
session_start();

// az adatbázis-információkat konstans 'változókba' definiálom
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'egyszerucms');

// csatlakozás felépítése
// @-cal elnyeljük az esetleges hibákat, hogy ne kerüljenek ki
$connection = @mysql_connect(DBHOST, DBUSER, DBPASS);
$connection = @mysql_select_db(DBNAME);

// mivel a hibát elnyeltük, ezért kiírathatunk saját hibaüzenetet
if (!$connection) {
    die("Sajnálom, a csatlakozás nem sikerült!");
}

// hogy ne kelljen minden egyes oldalnál külön beállítgatni a nevet, fejlécet stb,
// ezért itt konstansokban azokat is definiálom
// fontos a link végén a per-jel, mert ha hozzá akarunk később fűzni valamit, akkor különben object not found errort kapunk
define('DIR', 'http://localhost/egyszeruCMS/');
define('DIRADMIN', 'http://localhost/egyszeruCMS/admin/');
define('OLDALFEJLEC', 'Ruander Egyszerű CMS');

// az eljárásokat szintén egy külön fájlban hozom létre, amit a konfiguráción keresztül fogok használni
// biztonsági okokból nem engedem megnyitni az eljárásokat tartalmazó fájlt külön
// ezért itt definiálok egy egyszerű konstanst (amit a másik fájlban lekezelek)

//bennevan-e konstans definiálása :)
define('BENNEVANE', 1);

// itt az eljárásokat tartalmazó fájlt include-oljuk
include 'eljarasok.php';



