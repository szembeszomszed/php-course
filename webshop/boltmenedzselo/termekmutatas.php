<?php

session_start();
$output = "";

if (!isset($_SESSION['manager'])) {
    header('Location: http://localhost:8080/webshop/boltmenedzselo/menedzselo_login.php');
    exit();
}

if (filter_input(INPUT_GET, 'pid')) {
    $productId = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_NUMBER_INT);

    if(filter_var($productId, FILTER_VALIDATE_INT)) {

        require '../boltszkriptek/kapcsolat_a_mysqlhez.php';

        $sql = mysqli_query($dblink, "SELECT * FROM products WHERE `id`='$productId' LIMIT 1") or die(mysqli_error($dblink));

        $result = mysqli_fetch_assoc($sql);

        $productName = $result['product_name'];
        $price = $result['price'];
        $details = $result['details'];
        $category = $result['category'];
        $subcategory = $result['subcategory'];
        $dateAdded = $result['date_added'];

        $output = '<table border="1" cellspacing="0" cellpadding="0" style="text-align: center;">'
            . '<tr>'
            . '<th>Azonosító</th>'
            . '<th>Termék neve</th>'
            . '<th>Termék ára</th>'
            . '<th>Kategória</th>'
            . '<th>Alkategória</th>'
            . '<th>Termékadatok</th>'
            . '<th>Termékkép</th>'
            . '<th>Hozzáadás dátuma</th>'
            . '</tr>'
            . '<tr>'
            . '<td>'.$productId.'</td>'
            . '<td>'.$productName.'</td>'
            . '<td>'.$price.'</td>'
            . '<td>'.$category.'</td>'
            . '<td>'.$subcategory.'</td>'
            . '<td>'.$details.'</td>'
            . '<td style="width:50px; height:50px;"><img style="display:block;" width="100%" height="100%" src="../termekkepek/'.$productId.'.jpg"/></td>'
            . '<td>'.$dateAdded.'</td>'
            . '</tr>'
            . '</table>'
            . '<br/> <a href="./termeklista.php">Vissza</a>';
    } else {
        header('Location: termeklista.php');
        exit();
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Termék - <?php echo $productName; ?></title>
    </head>
    <body>
        <div align="center">
            <!-- header -->
            <?php include '../fejlec_sablon.php'; ?>
            <div align="right">
                <table width="20%">
                    <tr>
                        <td><a href="./index.php?logout">Kilépés</a></td>
                    </tr>
                </table>
            </div>
        <!-- end of header -->
            <div id="pageContent">
                <?php echo $output; ?>
            </div>

        </div>
    </body>
</html>

