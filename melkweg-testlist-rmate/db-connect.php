<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'melkweg-testdb';

$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Unable to connect to database.");

//echo "connected to database";