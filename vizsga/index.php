<?php

require 'scripts/db-connect.php';

if(filter_input(INPUT_GET,'submit')) {
    $orderBy = filter_input(INPUT_GET, 'order');
    
    
    switch ($orderBy) {
        case '1' : 
            $result = mysqli_query($dblink, "SELECT * FROM products ORDER BY `product_name` ASC") or die(mysqli_error($dblink));
            break;
        case '2' :
            $result = mysqli_query($dblink, "SELECT * FROM products ORDER BY `product_name` DESC") or die(mysqli_error($dblink));            break;
        case '3' :
            $result = mysqli_query($dblink, "SELECT * FROM products ORDER BY `price` ASC") or die(mysqli_error($dblink));                   break;
        case '4' :
            $result = mysqli_query($dblink, "SELECT * FROM products ORDER BY `price` DESC") or die(mysqli_error($dblink));                   break;
        default :
            $result = mysqli_query($dblink, "SELECT * FROM products ORDER BY `product_name` ASC") or die(mysqli_error($dblink));   }
    

} else {
    $result = mysqli_query($dblink, "SELECT * FROM products ORDER BY `product_name` ASC") or die(mysqli_error($dblink));
}

$output = '<h2>Product List</h2>'
        . '<table border="1" style="border-collapse: collapse; text-align: center;">'
        . '<tr>'
        . '<th>Product Name</th>'
        . '<th>Price</th>'
        . '<th>Details</th>'
        . '</tr>';

while ($row = mysqli_fetch_array($result)) {
    $productId = $row['pid'];
    $productName = $row['product_name'];
    $price = $row['price'];
    $details = $row['details'];

    $output .= '<tr>'
            . '<td>' . $productName . '</td>'
            . '<td>' . $price . ' Ft</td>'
            . '<td>' . $details . '</td>'
            . '</tr>';
}

$output .= '</table>';



?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo $output;        
        ?>
        
        <br/>
        <br/>
        <form method="get">
            <label for="order">Sort Table by</label>
            <select name="order">
                <option value="0">--select sorting style--</option>
                <option value="1">Product Name ascending</option>
                <option value="2">Product Name descending</option>
                <option value="3">Price ascending</option>
                <option value="4">Price descending</option>
            </select>
            <input type="submit" name="submit" value="Sort">
        </form>
    </body>
</html>
