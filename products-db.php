<?php

session_start();
session_destroy();
$loginError = "";
if (isset($_POST['user_name'])) {
    if ($_POST['user_name'] == "admin") {
        session_start();
        $_SESSION['name'] = $_POST['user_name']; //a session name kulcsára beállítjuk a formba beírt user_name-kulcsot
        header("Location: products-db-admin-page.php"); //átírányítom a megfelelő oldalra
    } else {
    $loginError = '<p style="color: red">Incorrect username.</p>';
    }
}


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = "";
$dbname = "classicmodels";

//connection to MySQL
$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Unable to connect to database.");
mysqli_select_db($dblink, $dbname) or die(mysqli_error());
mysqli_set_charset($dblink, 'utf-8');

$result = mysqli_query($dblink, "SELECT `productCode`, `productName`, `productLine`, `quantityInStock`, `buyPrice` FROM products") or die(mysqli_error());

$output = '<table border="1" style="border-collapse: collapse">'
    .'<tr>'
    .'<th>Product Code</th>'
    .'<th>Product Name</th>'
    .'<th>Product Line</th>'
    .'<th>Quantity in Stock</th>'
    .'<th>Buy Price</th>'
    .'</tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>"
        . "<td>{$row['productCode']}</td>"
        . "<td>{$row['productName']}</td>"
        . "<td>{$row['productLine']}</td>"
        . "<td>{$row["quantityInStock"]}</td>"
        . "<td>{$row["buyPrice"]}</td>"
        ."</tr>";
}

$output .= '</table>';



?>



<!DOCTYPE html>
<html>
<head>
    <style>
        #login-form {
            margin: -2300px 0 0 800px;
        }
        #submit {
            margin-left: 126px;
        }
    </style>

</head>

<body>
<?php
echo $output;
?>
<div id="login-form">
    <form id="main_form" method="post">
        <input type="text" name="user_name" size="20" placeholder="Enter your user name"/>
        <br/>
        <input type="submit" id="submit" value="Login"/>
    </form>
    <?php
    echo $loginError;
    ?>
</div>


</body>


</html>
