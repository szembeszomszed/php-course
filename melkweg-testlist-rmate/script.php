<?php

// db connection
require 'db-connect.php';

$message = '';
$output = '<form method="post">'
    . '<label for="name">Product Name</label><br/>'
    . '<input type="text" name="name" size="35" maxlength="30" placeholder="Enter product name"><br/><br/>'
    . '<label for="description">Product Description</label><br/>'
    . '<textarea name="description" rows="6" cols="50" maxlength="255" placeholder="Enter product description"></textarea><br/><br/>'
    . '<input type="submit" name="submit" value="Add">'
    . '</form>';

if (filter_input(INPUT_POST, 'submit')) {

    // check if fields are filled in
    if (filter_input(INPUT_POST, 'name') && filter_input(INPUT_POST, 'description')) {

        // save data in variables after sanitizing them
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

        // query string
        $add = "INSERT INTO productlist"
            . "(`productName`, `productDescription`)"
            . "VALUES ('$name', '$description')";

        // start query
        mysqli_query($dblink, $add) or die("Error in connection to database.");

        $message = '<p style="color: green;">Data added successfully.</p>';

    } else {
        $message = '<p style="color: red;">All fields are mandatory.</p>';
    }
}

$getList = "SELECT * FROM productlist";
$query = mysqli_query($dblink, $getList) or die("Error in connection to database.");

$numberOfRows = mysqli_num_rows($query);

// display table if db is not empty
if ($numberOfRows > 0) {
    $output .= '<br/><br/>'
        . '<table border="1px" style="border-collapse: collapse;">'
        . '<tr>'
        . '<th>Product ID</th>'
        . '<th>Product Name</th>'
        . '<th>Product Description</th>'
        . '</tr>';

    while($row = mysqli_fetch_assoc($query)) {
        $output .= '<tr>'
            . '<td>'.$row["productId"].'</td>'
            . '<td>'.$row["productName"].'</td>'
            . '<td>'.$row["productDescription"].'</td>'
            . '<td><a href="?del='.$row['productId'].'">Delete</a></td>'
            . '</tr>';
    }
    $output .= '</table>';
}

// get id of product to be deleted
if (filter_input(INPUT_GET, 'del')) {
    $id = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT);
    $getProduct = "SELECT * FROM productlist WHERE `productId`='$id' LIMIT 1";

    $query2 = mysqli_query($dblink, $getProduct) or die("Error in connection to database.");
    $row = mysqli_fetch_assoc($query2);

    $productNameDel = $row['productName'];
    $productDescriptionDel = $row['productDescription'];

    // display product details for confirmation
    $output = '<h2 style="color: red;">You are about to delete the following data:</h2>'
        . '<table border="1" style="border-collapse: collapse; text-align: center;">'
        . '<tr>'
        . '<th>Product ID</th>'
        . '<th>Product Name</th>'
        . '<th>Product Description</th>'
        . '</tr>'
        . '<tr>'
        . '<td>'.$id.'</td>'
        . '<td>'.$productNameDel.'</td>'
        . '<td>'.$productDescriptionDel.'</td>'
        . '</tr><br/><br/>'
        . '<a href="admin-page.php">Back to product list</a> || <a style="color: red;" href="admin-page.php?del='.$id.'&amp;confirm=ok">Confirm</a><br/><br/>';

    // get confirmation and delete
    if (filter_input(INPUT_GET, 'confirm')) {
        $confirm = filter_input(INPUT_GET, 'confirm');
        $delProduct = "DELETE FROM productlist WHERE `productId`='$id'";
        mysqli_query($dblink, $delProduct) or die("Error in connection to database.");

        $output = '<a href="admin-page.php">Back to product list</a><br/><br/>'
            .'<p style="color:green;">Product successfully deleted,</p><br/>';
    }
}

