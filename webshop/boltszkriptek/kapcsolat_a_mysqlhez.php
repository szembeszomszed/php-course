<?php

// mysql kapcsolat felépítése
// változók deklarálása

$db_host = 'localhost';
$db_username = 'root';
$db_pass = '';
$db_name = 'webshop';

// kapcsolat futtatása
$dblink = mysqli_connect($db_host, $db_username, $db_pass, $db_name) or die(mysqli_error($dblink));
//mysql_select_db($db_name) or die(mysql_error());

