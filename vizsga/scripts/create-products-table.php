<?php

require './db-connect.php';

mysqli_query($dblink, "CREATE TABLE products (`pid` int(8) NOT NULL AUTO_INCREMENT, `product_name` varchar(30) NOT NULL, `price` varchar(10) NOT NULL, `details` text, PRIMARY KEY (`pid`), UNIQUE KEY(`product_name`))") or die(mysqli_error($dblink));

//echo "products table created";

