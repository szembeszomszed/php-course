<?php

require './kapcsolat_a_mysqlhez.php';

$sql = mysqli_query($dblink, "CREATE TABLE products("
        . "id int(11) NOT NULL AUTO_INCREMENT,"
        . "product_name VARCHAR(255) NOT NULL,"
        . "price VARCHAR(20) NOT NULL,"
        . "details text,"
        . "category VARCHAR(20) NOT NULL,"
        . "subcategory VARCHAR(20) NOT NULL,"
        . "date_added date NOT NULL,"
        . "PRIMARY KEY(id),"
        . "UNIQUE KEY product_name(product_name))") or die(mysqli_error($dblink));

if ($sql) {
    echo "<h2>A products tábla sikeresen létrehozva az adatbázisban</h2>";
} else {
    // ha jól sejtem, ez az ág csak a mysql_error() eltávolítása után lehet érdekes
    echo "<h2>KRITIKUS HIBA! Nem hoztunk létre semmit sem!</h2>";
}

