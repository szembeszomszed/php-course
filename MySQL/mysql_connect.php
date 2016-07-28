<?php

// csatlakozunk az üres adatbázishoz, és a MySQL-hez

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error()); // minden mysql függvény végéhez hozzáilleszhetjük a die()-t, ami hiba esetén megállít minden futást, és ha a paraméterében hozzátesszük a hibát, akkor azt ő kiírja

// ha csak a felhasználónév rossz, a MySQL-hez igen, de a táblához nem tudunk csatlakozni

// FONTOS! az or die(mysql_error()) CSAK FEJLESZTÉS ALATT legyen a projektben, biztonságtechnikai megfontolásból
// FONTOS! élesben minden mysql függvény elé tegyük be a @ operátort, mert az elnyeli az azt követő függvény hibáit

// tehát az or die() sem kell élesben, hanem már rögtön így indítunk:
//@mysql_connect("localhost", "root", "")


// mysql_connect paraméterei:
// 1) szerver, ahol az adatbázis található  - a mi esetünkben ez localhost lesz, shared hosting esetén is
        // ha másutt van a szerver, akkor ip-cím alapján megadható a dolog
// 2) felhasználónév: root -> ez a default felhasználó - egyébként konfigurálni kéne a dolgot
        // éles helyzetben az adatbázishoz tartozó felhasználónevünket használjuk
// 3) jelszó: a xampp-ban alapesetben: "" (üres)

echo '<h2>Sikeresen csatlakoztunk a MySQL-hez!</h2>'; 
// ha ezt az üzenetet látjuk, akkor sikerült a csatlakozás
// ellenkező esetben ugye a die() miatt nem jutunk el idáig


// a létrehozott tesztdb-hez csatlakozunk

mysql_select_db("tesztdb") or die(mysql_error());
echo '<h2>Sikeresen csatlakoztunk az adatbázishoz!</h2>';
// ide már a jó felhasználónév is kellett

// ha shared hostingot bérlünk, meg kell kérdezni, mennyi konkrétan a MySQL-hez tartozó memória és a tárhely
// tehát konkrétan az adatbázishoz tartozó memória és tárhely is megfelelő méretű kell, hogy legyen
// ellenkező esetben a szerver lelövi az oldalt
// legalább egy VPS legyen bérelve (ha nem is dedikált szerver), nagyobb projektekhez
// jó cég: https://www.webtropia.com/



