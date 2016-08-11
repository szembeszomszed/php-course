<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'vizsga_retsagi-mate';

$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("connection failed");

//echo "connected to database";

