<?php

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());

// ha törölni szeretnénk egy meglévő recordot, azt a DELETE utasítás segítségével tehetjük meg

// kitöröljük azt a sort (vagy hát ha úgy van, azokat a sorokat), ahol az age = 15
$eredmeny = mysql_query("DELETE FROM pelda WHERE age='15'") or die(mysql_error());

echo 'sikeres törlés';
