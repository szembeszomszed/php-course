<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = "";
$dbname = "classicmodels";

//connection to MySQL
$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Unable to connect to database.");
mysqli_select_db($dblink, $dbname) or die(mysqli_error());

//echo '<p>Connection has been established.</p>';

if (filter_input(INPUT_GET, 'act')) {
    $action = filter_input(INPUT_GET, 'act');
} else {
    $action = 'list';
}

if (filter_input(INPUT_GET, 'order')) {
    $order = filter_input(INPUT_GET, 'order');
} else {
    $order = 'list';
}

if (filter_input(INPUT_GET, 'pid')) {
    $productId = filter_input(INPUT_GET, 'pid')
} else {
    $productId = null;
}


$result = mysqli_query($dblink, "SELECT `productCode`, `productName`, `productLine`, `quantityInStock`, `buyPrice` FROM products") or die(mysqli_error());

$output = '<a href="?act=new">New entry</a> | <a href="?act=order">Order table</a><br/><br/>'
    .'<table border="1" style="border-collapse: collapse">'
    .'<tr>'
    .'<th>Product Code</th>'
    .'<th>Product Name</th>'
    .'<th>Product Line</th>'
    .'<th>Quantity in Stock</th>'
    .'<th>Buy Price</th>'
    .'<th>Action</th>'
    .'</tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>"
        . "<td>{$row['productCode']}</td>"
        . "<td>{$row['productName']}</td>"
        . "<td>{$row['productLine']}</td>"
        . "<td>{$row["quantityInStock"]}</td>"
        . "<td>{$row["buyPrice"]}</td>"
        . "<td><a href='?act=mod&amp;pid={$row['productCode']}'>Modify</a> | <a href='?act=del&amp;pid={$row['productCode']}'>Delete</a></td>"
        ."</tr>";
}

$output .= '</table>';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products Table</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php echo $output;?>
    </body>



</html>

