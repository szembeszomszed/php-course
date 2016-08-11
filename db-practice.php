<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';

$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die();
//echo "connected to db";

/*
$createTable = mysqli_query($dblink, "CREATE TABLE testTable (userid int(11) NOT NULL AUTO_INCREMENT, username varchar(15) NOT NULL, email varchar(30) NOT NULL, password varchar(20) NOT NULL, PRIMARY KEY(userid), UNIQUE KEY(username, email))") or die(mysqli_error($dblink));
echo "table created";
*/

/*
mysqli_query($dblink, "INSERT INTO testTable (`userid`, `username`, `email`, `password`) VALUES ('1', 'Karcsi', 'karcsi@karcsi.hu', 'jelszo1')");
mysqli_query($dblink, "INSERT INTO testTable (`userid`, `username`, `email`, `password`) VALUES ('2', 'Lajcsi', 'lajcsi@lajcsi.hu', 'jelszo2')");
*/

/*
mysqli_query($dblink, "UPDATE testTable SET `username`='Marcsi', `email`='marcsi@marcsi.hu' WHERE `username`='Lajcsi'") or die(mysqli_error($dblink));
echo "data modified";
*/

/*
mysqli_query($dblink, "INSERT INTO testTable (`username`, `email`, `password`) VALUES ('Bela', 'bela@bela.hu', 'jelszo3')") or die(mysqli_error($dblink));
echo "data added";
*/

/*
mysqli_query($dblink, "DELETE FROM testTable WHERE `userid`='3'") or die(mysqli_error($dblink));
echo "data deleted";
*/

/*
mysqli_query($dblink, "CREATE TABLE proba (id int(5) NOT NULL AUTO_INCREMENT, name varchar(20) NOT NULL, price int(10) NOT NULL, PRIMARY KEY(id), UNIQUE KEY(name))") or die(mysqli_error($dblink));
echo "table created";
*/

/*
mysqli_query($dblink, "INSERT INTO proba (`name`, `price`) VALUES ('zsomle', '15')") or die(mysqli_error($dblink));
echo "data added";
*/

/*
mysqli_query($dblink, "INSERT INTO proba (`name`, `price`) VALUES ('kifli', '16')") or die(mysqli_error($dblink));
echo "data added";
*/

/*
mysqli_query($dblink, "UPDATE proba SET `price`='25' WHERE `name`='kifli'") or die(mysqli_error($dblink));
echo "data modified";
*/

/*
mysqli_query($dblink, "DELETE FROM proba WHERE `name`='zsomle'") or die(mysqli_error($dblink));
echo "data deleted";
*/
