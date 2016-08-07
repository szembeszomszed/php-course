<?php

require 'boltszkriptek/kapcsolat_a_mysqlhez.php';

$output = '<form method="post">'
    //.'<label for="order">Rendezés</label><br/>'
    .'<select name="order" id="order">'
    .'<option value="0">---Válasszon rendezési módot---</option>'
    .'<option value="1">Név szerint növekvő</option>'
    .'<option value="2">Név szerint csökkenő</option>'
    .'<option value="3">Ár szerint növekvő</option>'
    .'<option value="4">Ár szerint csökkenő</option>'
    .'</select>'
    .'<input type="submit" name="submit" value="Rendez">'
    .'</form>'
    .'<br/>';

if(filter_input(INPUT_POST, 'submit')) {
    $orderMethod = filter_input(INPUT_POST, 'order');

    switch ($orderMethod) {
        case '1' :
            $sql = mysqli_query($dblink, "SELECT `id`, `product_name`, `price` from products ORDER BY `product_name` ASC") or die(mysqli_error($dblink));
            break;
        case '2' :
            $sql = mysqli_query($dblink, "SELECT `id`, `product_name`, `price` from products ORDER BY `product_name` DESC") or die(mysqli_error($dblink));
            break;
        case '3' :
            $sql = mysqli_query($dblink, "SELECT `id`, `product_name`, `price` from products ORDER BY `price` ASC") or die(mysqli_error($dblink));
            break;
        case '4' :
            $sql = mysqli_query($dblink, "SELECT `id`, `product_name`, `price` from products ORDER BY `price` DESC") or die(mysqli_error($dblink));
            break;
        default :
            $sql = mysqli_query($dblink, "SELECT `id`, `product_name`, `price` from products ORDER BY `product_name` ASC") or die(mysqli_error($dblink));
    }
} else {
    $sql = mysqli_query($dblink, "SELECT `id`, `product_name`, `price` from products ORDER BY `product_name` ASC") or die(mysqli_error($dblink));
}


//$sql = mysqli_query($dblink, "SELECT `id`, `product_name`, `price` from products ORDER BY `product_name` ASC") or die(mysqli_error($dblink));

$numberOfRows = mysqli_num_rows($sql);

if ($numberOfRows > 0) {
    $output .= '<table border="1" cellspacing="0" cellpadding="0" style="text-align: center;">'
        . '<tr>'
        . '<th>Termék neve</th>'
        . '<th>Termék ára</th>'
        . '<th>Fotó</th>'
        . '<th>Művelet</th>'
        . '</tr>';
    while ($row = mysqli_fetch_assoc($sql)) {
        $output .= '<tr>'
            . '<td>'. $row["product_name"]. '</td>'
            . '<td>'. $row["price"]. ' Ft</td>'
            . '<td style="width:50px; height:50px;"><img style="display:block;" width="100%" height="100%" src="termekkepek/'.$row["id"].'.jpg"/></td>'
            . '<td><a href="index.php?show='.$row["id"].'">Mutat</a></td>'
            . '</tr>';
    }
    $output .= '</table>';
} else {
    $output = "<p>Nincs megjeleníthető termék.</p>";
}


if (filter_input(INPUT_GET, 'show')) {
    $showId = filter_input(INPUT_GET, 'show');

    $sql = mysqli_query($dblink, "SELECT * FROM products WHERE `id`='$showId'") or die(mysqli_error($dblink));
    $result = mysqli_fetch_assoc($sql);

    $productId = $result['id'];
    $productName = $result['product_name'];
    $price = $result['price'];
    $details = $result['details'];
    $category = $result['category'];
    $subcategory = $result['subcategory'];
    //$dateAdded = $result['date_added']; NOT REQUIRED IN USER VIEW

    $output = '<table border="1" cellspacing="0" cellpadding="0" style="text-align: center;">'
        . '<tr>'
        . '<th>Termék neve</th>'
        . '<th>Termék ára</th>'
        . '<th>Kategória</th>'
        . '<th>Alkategória</th>'
        . '<th>Termékadatok</th>'
        . '<th>Termékkép</th>'
        . '</tr>'
        . '<tr>'
        . '<td>' . $productName . '</td>'
        . '<td>' . $price . ' Ft</td>'
        . '<td>' . $category . '</td>'
        . '<td>' . $subcategory . '</td>'
        . '<td>' . $details . '</td>'
        . '<td style="width:50px; height:50px;"><img style="display:block;" width="100%" height="100%" src="termekkepek/' . $productId . '.jpg"/></td>'
        . '</tr>'
        . '</table>'
        . '<br/> <a href="index.php">Vissza</a>';
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
        <!--
        keep selected value in drop-down after submission - not yet working
        <script type="text/javascript">
            document.getElementById('order').value = "<?php// echo $_POST['order'];?>";
        </script>
        -->
    </head>
    <body>
        <?php
        echo $output;
        ?>
    </body>
</html>
