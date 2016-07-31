<?php

session_start();
if (!isset($_SESSION['name'])) {
    header("Location: products-db.php"); //ha nem lett beállítva a name, visszairányítjuk az előző oldalra
} else {
    $name = $_SESSION['name'];
}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = "";
$dbname = "classicmodels";

//connection to MySQL
$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Unable to connect to database.");
mysqli_select_db($dblink, $dbname) or die(mysqli_error());

//echo '<p>Connection has been established.</p>';

mysqli_set_charset($dblink, 'utf-8');

if (filter_input(INPUT_GET, 'act')) {
    $action = filter_input(INPUT_GET, 'act');
} else {
    $action = 'list';
}

/*
if (filter_input(INPUT_GET, 'order')) {
    $order = filter_input(INPUT_GET, 'order');
} else {
    $order = 'list';
}
*/

if (filter_input(INPUT_GET, 'pid')) {
    $productId = filter_input(INPUT_GET, 'pid');
} else {
    $productId = null;
}

switch ($action) {
    case 'new':

        if (filter_input(INPUT_POST, 'submit')) {
            $formError = [];
            function pIdFormatCheck ($pid) {
                if (mb_substr($pid, 0, 1) != "S" || strpos($pid, "_") == false) {
                    $formError['pid'] = '<p style="color: red; display: inline;">Required format for Product Code: S12_3456</p>';
                    return false;
                }
                return $pid;
            }

            $customFilter = [
                'pid' => FILTER_SANITIZE_STRING,
                'pname' => FILTER_SANITIZE_STRING,
                'pline' => FILTER_SANITIZE_STRING,
                'quant' => FILTER_VALIDATE_INT,
                'bprice' => FILTER_VALIDATE_FLOAT,
            ];

            $data = filter_input_array(INPUT_POST, $customFilter, $add_empty = true);

            // ERROR HANDLING

            if ($data['pid'] == "") {
                $formError['pid'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            } elseif (mb_substr($data['pid'], 0, 1) != "S" || strpos($data['pid'], "_") == false) {
                $formError['pid'] = '<p style="color: red; display: inline;">Required format for Product Code: S12_3456</p>';
            } else {
                $pIdExists = mysqli_query($dblink, "SELECT * FROM products WHERE `productCode` = '$data[pid]'") or die(mysqli_error($dblink));
                $numberOfRows = mysqli_num_rows($pIdExists);
                if ($numberOfRows > 0) {
                    $formError['pid'] = '<p style="color: red; display: inline;">Product Code already exists in the database.</p>';
                }
            }

            if ($data['pname'] == "") {
                $formError['pname'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            if ($data['pline'] == "") {
                $formError['pline'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            if ($data['quant'] == "") {
                $formError['quant'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            if ($data['bprice'] == "") {
                $formError['bprice'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            /*
            foreach ($data as $field => $entry) {
                if ($entry == "") { // check if any field is empty
                   $formError[$field] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
                    //echo $formError[$field];
                }
            }
            */

            if (empty($formError)) {
                mysqli_query($dblink, "INSERT INTO products (`productCode`, `productName`, `productLine`, `quantityInStock`, `buyPrice`)
                              VALUES ('$data[pid]', '$data[pname]', '$data[pline]', '$data[quant]', '$data[bprice]')") or die(mysqli_error($dblink));
                echo '<p style="color: green;">Record has been added to database.</p>';
            }
        }
        $output = '<a href="?act=list">Back to list</a><br/><br/>'
            . '<form method="post">'
            . '<label for="pid">Product Code</label>'
            . '<br/>'
            . '<input type="text" name="pid" placeholder="S00-0000">' . (empty($formError["pid"]) ? "" : $formError["pid"])
            . '<br/>'
            . '<br/>'
            . '<label for="pname">Product Name</label>'
            . '<br/>'
            . '<input type="text" name="pname" placeholder="Sample Product">' . (empty($formError["pname"]) ? "" : $formError["pname"])
            . '<br/>'
            . '<br/>'
            . '<label for="pline">Product Line</label>'
            . '<br/>'
            . '<input type="text" name="pline" placeholder="Sample Product Line">' . (empty($formError["pline"]) ? "" : $formError["pline"])
            . '<br/>'
            . '<br/>'
            . '<label for="quant">Quantity in Stock</label>'
            . '<br/>'
            . '<input type="text" name="quant" placeholder="1234">' . (empty($formError["quant"]) ? "" : $formError["quant"])
            . '<br/>'
            . '<br/>'
            . '<label for="bprice">Buy Price</label>'
            . '<br/>'
            . '<input type="text" name="bprice" placeholder="12.34">' . (empty($formError["bprice"]) ? "" : $formError["bprice"])
            . '<br/>'
            . '<br/>'
            . '<input type="submit" name="submit" value="Submit">'
            . '</form>';

        break;

    case 'del':
        if (filter_input(INPUT_GET, 'confirm')) {
            $confirm = filter_input(INPUT_GET, 'confirm');
        } else {
            $confirm = 'list';
        }
        $dataToDelete = mysqli_query($dblink, "SELECT `productCode`, `productName`, `productLine`, `quantityInStock`, `buyPrice` FROM products WHERE `productCode` = '$productId'") or die(mysqli_error($dblink));
        $row = mysqli_fetch_assoc($dataToDelete) or die(mysqli_error());
        $productName = $row['productName'];
        $productLine = $row['productLine'];
        $quantityInStock = $row['quantityInStock'];
        $buyPrice = $row['buyPrice'];

        if ($productId) {

            $output = '<a href="?act=list">Back to list</a><br/><br/>'
                . '<p> The following record will be deleted: </p><br/><br/>'
                . '<table border="1" style="text-align: center; border-collapse: collapse;">'
                . '<tr>'
                . '<th>Product Code</th>'
                . '<th>Product Name</th>'
                . '<th>Product Line</th>'
                . '<th>Quantity in Stock</th>'
                . '<th>Buy Price</th>'
                . '</tr>'
                . '<tr>'
                . '<td>'.$productId.'</td>'
                . '<td>'.$productName.'</td>'
                . '<td>'.$productLine.'</td>'
                . '<td>'.$quantityInStock.'</td>'
                . '<td>'.$buyPrice.'</td>'
                . '</tr>'
                . '</table><br/><br/>'
                . "<a style='color: red;' href='?act=del&amp;pid={$row['productCode']}&amp;confirm=delete'>Click to confirm</a>";
            }

        if ($confirm == 'delete') {
            mysqli_query($dblink, "DELETE FROM products WHERE `productCode` = '$productId'") or die(mysqli_error());
            $output = '<a href="?act=list">Back to list</a><br/><br/>'
                . '<p style="color: green;">Record has been deleted.</p>';
        }
    break;

    case 'mod':
        $output = '<a href="?act=list">Back to list</a><br/><br/>';
        $output .= '<h3>Modify the following record:</h3>';
        $dataToModify = mysqli_query($dblink, "SELECT `productCode`, `productName`, `productLine`, `quantityInStock`, `buyPrice` FROM products WHERE `productCode` = '$productId'") or die(mysqli_error($dblink));
        $row = mysqli_fetch_assoc($dataToModify) or die(mysqli_error());
        $productCode = $row['productCode'];
        $productName = $row['productName'];
        $productLine = $row['productLine'];
        $quantityInStock = $row['quantityInStock'];
        $buyPrice = $row['buyPrice'];
        $formError = [];

        $output .= '<form method="post">'
            . '<label for="pid">Product Code</label>'
            . '<br/>'
            . '<input type="text" name="pid" placeholder="S00-0000" value="'.$productCode.'" size="40">' . (empty($formError["pid"]) ? "" : $formError["pid"])
            . '<br/>'
            . '<br/>'
            . '<label for="pname">Product Name</label>'
            . '<br/>'
            . '<input type="text" name="pname" placeholder="Sample Product" value="'.$productName.'"size="40">' . (empty($formError["pname"]) ? "" : $formError["pname"])
            . '<br/>'
            . '<br/>'
            . '<label for="pline">Product Line</label>'
            . '<br/>'
            . '<input type="text" name="pline" placeholder="Sample Product Line" value="'.$productLine.'"size="40">' . (empty($formError["pline"]) ? "" : $formError["pline"])
            . '<br/>'
            . '<br/>'
            . '<label for="quant">Quantity in Stock</label>'
            . '<br/>'
            . '<input type="text" name="quant" placeholder="1234" value="'.$quantityInStock.'"size="40">' . (empty($formError["quant"]) ? "" : $formError["quant"])
            . '<br/>'
            . '<br/>'
            . '<label for="bprice">Buy Price</label>'
            . '<br/>'
            . '<input type="text" name="bprice" placeholder="12.34" value="'.$buyPrice.'"size="40">' . (empty($formError["bprice"]) ? "" : $formError["bprice"])
            . '<br/>'
            . '<br/>'
            . '<input type="submit" name="submit" value="Submit">'
            . '</form>';

        if (filter_input(INPUT_POST, 'submit')) {
            $customFilter = [
                'pid' => FILTER_SANITIZE_STRING,
                'pname' => FILTER_SANITIZE_STRING,
                'pline' => FILTER_SANITIZE_STRING,
                'quant' => FILTER_VALIDATE_INT,
                'bprice' => FILTER_VALIDATE_FLOAT,
            ];

            $modifiedData = filter_input_array(INPUT_POST, $customFilter, $add_empty = true);

            // ERROR HANDLING

            if ($modifiedData['pid'] == "") {
                $formError['pid'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            } elseif (mb_substr($modifiedData['pid'], 0, 1) != "S" || strpos($modifiedData['pid'], "_") == false) {
                $formError['pid'] = '<p style="color: red; display: inline;">Required format for Product Code: S12_3456</p>';
            }

            if ($modifiedData['pname'] == "") {
                $formError['pname'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            if ($modifiedData['pline'] == "") {
                $formError['pline'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            if ($modifiedData['quant'] == "") {
                $formError['quant'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            if ($modifiedData['bprice'] == "") {
                $formError['bprice'] = '<p style="color: red; display: inline;">Field can not be empty.</p>';
            }

            if (empty($formError)) {
                mysqli_query($dblink, "UPDATE products SET `productName` = '$modifiedData[pname]', `productLine` = '$modifiedData[pline]', `quantityInStock` = '$modifiedData[quant]', `buyPrice` = '$modifiedData[bprice]' WHERE `productCode` = '$productId'") or die(mysqli_error($dblink));
                $output = '<a href="?act=list">Back to list</a><br/><br/>'
                    . '<p style="color: green;">Record has been modified.</p>';
            }
        }
        break;
    case "order":
        if (filter_input(INPUT_POST, 'submit')) {
            //$output = '<a href="?act=list">Back to list</a><br/><br/>';
            $orderChoice = filter_input_array(INPUT_POST);
            //var_dump($orderChoice);

            $orderBy = $orderChoice['ordby'];
            $dir = $orderChoice['dir'];

            function orderTable ($ord, $dir) {
                global $dblink;
                $result = mysqli_query($dblink, "SELECT `productCode`, `productName`, `productLine`, `quantityInStock`, `buyPrice` FROM products ORDER BY `$ord` $dir") or die(mysqli_error($dblink));
                echo '<br/><br/><table border="1" style="border-collapse: collapse">'
                    .'<tr>'
                    .'<th>Product Code</th>'
                    .'<th>Product Name</th>'
                    .'<th>Product Line</th>'
                    .'<th>Quantity in Stock</th>'
                    .'<th>Buy Price</th>'
                    .'</tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>"
                        . "<td>{$row['productCode']}</td>"
                        . "<td>{$row['productName']}</td>"
                        . "<td>{$row['productLine']}</td>"
                        . "<td>{$row["quantityInStock"]}</td>"
                        . "<td>{$row["buyPrice"]}</td>"
                        ."</tr>";
                }

            }
            orderTable($orderBy, $dir);

        }

        $output = '<a href="?act=list">Back to list</a><br/><br/>';
        $output .= '
        <form method="post">
            <strong><p>Order by</p></strong>
            <input type="radio" name="ordby" value="productCode">
            <label for="ordby">Product Code</label>
            <br/>
            <input type="radio" name="ordby" value="productName">
            <label for="ordby">Product Name</label>
            <br/>
            <input type="radio" name="ordby" value="productLine">
            <label for="ordby">Product Line</label>
            <br/>
            <input type="radio" name="ordby" value="quantityInStock">
            <label for="ordby">Quantity in Stock</label>
            <br/>
            <input type="radio" name="ordby" value="buyPrice">
            <label for="ordby">Buy Price</label>
            <br/>
            <strong><p>Direction</p></strong>
            <select name="dir">
                <option value="0">----Select Direction----</option>
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <br/><br/>
            <input type="submit" name="submit" value="Order Table">
        </form><br/><br/>';


        break;

    default:
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

}




?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products Table</title>
        <meta charset="UTF-8">
    </head>
    <body>
         <p style="margin-left: 1100px;"><a href="products-db.php">Logout</a></p>
        <?php echo $output;?>
    </body>



</html>

