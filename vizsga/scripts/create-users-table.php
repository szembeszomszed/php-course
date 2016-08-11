<?php

require './db-connect.php';

mysqli_query($dblink, "CREATE TABLE users (`uid` int(8) NOT NULL AUTO_INCREMENT, `user_name` varchar(30) NOT NULL, `user_email` varchar(50) NOT NULL, `password` varchar(20), PRIMARY KEY (`uid`), UNIQUE KEY(`user_name`, `user_email`))") or die(mysqli_error($dblink));

//echo "users table created";

