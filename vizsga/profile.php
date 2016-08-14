<?php 

require 'scripts/user-validation.php';
require 'scripts/db-connect.php';

if (filter_input(INPUT_GET, 'act')) {
    $action = filter_input(INPUT_GET, 'act');
} else {
    $action = 'list';
}

if (filter_input(INPUT_GET, 'pid')) {
    $pid = filter_input(INPUT_GET, 'pid');
} else {
    $pid = NULL;
}

switch ($action) {
        
    case 'new' :

        $productName = "";
        $price = "";
        $details = "";

        if (filter_input(INPUT_POST, 'submit')) {
            
            if (!empty(filter_input(INPUT_POST, 'pname')) && !empty(filter_input(INPUT_POST, 'price')) && !empty(filter_input(INPUT_POST, 'details'))) {
            $productName = filter_input(INPUT_POST, 'pname');
            $price = filter_input(INPUT_POST, 'price');
            $details = filter_input(INPUT_POST, 'details');
            
            $result = mysqli_query($dblink, "SELECT * FROM products WHERE `product_name`='$productName'") or die(mysqli_error($dblink));
            $numberOfRows = mysqli_num_rows($result);
            
                if ($numberOfRows == 0) {
                    
                    mysqli_query($dblink, "INSERT INTO products (`product_name`, `price`, `details`) VALUES ('$productName', '$price', '$details')") or die(mysqli_error($dblink));
                    
                    echo '<p style="color:green;">Product successfully added!</p><br/>';
                
                    
                } else {
                    echo "<p style=\"color: red;\">Product name already exists in the database!</p>";
                }           
            
            } else {
                echo "<p style=\"color: red;\">All fields are mandatory!</p>";
            }  
        }

        $output = '<a href="profile.php">Back to product list</a><br/><br/>'
            . '<h2>Add New Product</h2>'
            . '<form method="post">'
            . '<label for="pname">Product Name</label><br/>'
            . '<input type="text" name="pname" value="'.$productName.'"><br/><br/>'
            . '<label for="price">Price</label><br/>'
            . '<input type="text" name="price" value="'.$price.'"><br/><br/>'
            . '<label for="details">Details</label><br/>'
            . '<textarea name="details">'.$details.'</textarea><br/><br/>'
            . '<input type="submit" name="submit" value="Add">'
            . '</form>';

        break;
    case 'mod' :
        
        $result = mysqli_query($dblink, "SELECT * FROM products WHERE `pid`='$pid' LIMIT 1") or die(mysqli_error($dblink));
        
        $row = mysqli_fetch_array($result);
        
        $productName = $row['product_name'];
        $price = $row['price'];
        $details = $row['details'];
            
        $output = $output = '<a href="profile.php">Back to product list</a><br/><br/>'
        . '<h2>Modify Product</h2>'
        . '<form method="post">'
        . '<label for="pname">Product Name</label><br/>'
        . '<input type="text" name="pname" value="'.$productName.'"><br/><br/>'
        . '<label for="price">Price</label><br/>'
        . '<input type="text" name="price" value="'.$price.'"><br/><br/>'
        . '<label for="details">Details</label><br/>'
        . '<textarea name="details">'.$details.'</textarea><br/><br/>'
        . '<input type="submit" name="submit" value="Modify">'
        . '</form>';
        
        if (filter_input(INPUT_POST, 'submit')) {
            
            if (!empty(filter_input(INPUT_POST, 'pname')) && !empty(filter_input(INPUT_POST, 'price')) && !empty(filter_input(INPUT_POST, 'details'))) {
            $productName = filter_input(INPUT_POST, 'pname');
            $price = filter_input(INPUT_POST, 'price');
            $details = filter_input(INPUT_POST, 'details');
            
            mysqli_query($dblink, "UPDATE products SET `product_name`='$productName', `price`='$price', `details`='$details' WHERE `pid`='$pid' ") or die(mysqli_error($dblink));
                    
                    $output = '<a href="profile.php">Back to product list</a><br/><br/>'
                            .'<p style="color:green;">Product successfully modified!</p><br/>';         
            
            } else {
                echo "<p style=\"color: red;\">All fields are mandatory!</p>";
            }  
        }
        break;
    case 'del' :
        
        $result = mysqli_query($dblink, "SELECT * FROM products WHERE `pid`='$pid' LIMIT 1") or die(mysqli_error($dblink));
        
        $row = mysqli_fetch_array($result);
        
        $productName = $row['product_name'];
        $price = $row['price'];
        $details = $row['details'];
        
        $output .= '<h2 style="color: red;">You are about to delete the following data:</h2>'
        . '<table border="1" style="border-collapse: collapse; text-align: center;">'
        . '<tr>'
        . '<th>Product ID</th>'
        . '<th>Product Name</th>'
        . '<th>Price</th>'
        . '<th>Details</th>'
        . '</tr>'
        . '<tr>'
        . '<td>'.$pid.'</td>'
        . '<td>'.$productName.'</td>'
        . '<td>'.$price.'</td>'
        . '<td>'.$details.'</td>'
        . '</tr><br/><br/>'        
        . '<a href="profile.php">Back to product list</a> || <a style="color: red;" href="profile.php?act=del&amp;pid='.$pid.'&amp;confirm=delete">Confirm</a><br/><br/>';
        
        if (filter_input(INPUT_GET, 'confirm')) {
            $confirm = filter_input(INPUT_GET, 'confirm');
            mysqli_query($dblink, "DELETE FROM products WHERE `pid`='$pid'") or die(mysqli_error($dblink));
            
            $output = '<a href="profile.php">Back to product list</a><br/><br/>'
                      .'<p style="color:green;">Product successfully deleted!</p><br/>';
            
        }
        break;
    default :    
        
        $output = '<a href="profile.php?act=new">Add new product</a><br/><br/>';
                
        $output .= '<h2>Product List</h2>'
                . '<table border="1" style="border-collapse: collapse; text-align: center;">'
                . '<tr>'
                . '<th>Product ID</th>'
                . '<th>Product Name</th>'
                . '<th>Price</th>'
                . '<th>Details</th>'
                . '<th>Action</th>'
                . '</tr>';
        
        $result = mysqli_query($dblink, "SELECT * FROM products") or die(mysqli_error($dblink));       
                
        while ($row = mysqli_fetch_array($result)) {
            $productId = $row['pid'];
            $productName = $row['product_name'];
            $price = $row['price'];
            $details = $row['details'];
            
            $output .= '<tr>'
                    . '<td>'.$productId.'</td>'
                    . '<td>'.$productName.'</td>'
                    . '<td>'.$price.'</td>'
                    . '<td>'.$details.'</td>'
                    . '<td><a href=profile.php?act=mod&amp;pid='.$productId.'>Modify</a> | <a href="profile.php?act=del&amp;pid='.$productId.'">Delete</a></td>'
                    . '</tr>';
        }
        
        $output .= '</table>';
        
        break;                
        
}  

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
        <?php echo $output; ?>
    </body>
</html>
