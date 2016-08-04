<?php

require './kapcsolat_a_mysqlhez.php';

// élesben lehetőség szerint ne adminnak nevezzük el az admintáblát!

$sql = mysqli_query($dblink, "CREATE TABLE admin ("
        . "id int(11) NOT NULL AUTO_INCREMENT,"
        . "username VARCHAR(30) NOT NULL,"
        . "password VARCHAR(30) NOT NULL,"
        . "last_log_date date NOT NULL,"
        . "PRIMARY KEY(id),"
        . "UNIQUE KEY username(username))") or die(mysqli_error($dblink));

if ($sql) {
    echo "<h2>Az admin tábla sikeresen létrehozva az adatbázisban</h2>";
} else {
    // ha jól sejtem, ez az ág csak a mysql_error() eltávolítása után lehet érdekes
    echo "<h2>KRITIKUS HIBA! Nem hoztunk létre semmit sem!</h2>";
}