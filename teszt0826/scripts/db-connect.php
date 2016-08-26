<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'teszt0826';

$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("connection failed");

//echo "connected to $dbname";

