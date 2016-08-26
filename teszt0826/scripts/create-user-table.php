<?php

require 'db-connect.php';

mysqli_query($dblink, "CREATE TABLE users (`userId` int(8) NOT NULL AUTO_INCREMENT, `userName` varchar(12) NOT NULL, `userEmail` varchar(30) NOT NULL, `password` varchar(16) NOT NULL, PRIMARY KEY(`userId`))") or die(mysqli_error($dblink));
//echo "table created";