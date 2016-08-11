<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>


<?php
/* ÉN MEGOLDÁSOM
  if (filter_input(INPUT_GET, 'id')) {
  $pid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  require 'boltszkriptek/kapcsolat_a_mysqlhez.php';
  $sql = mysql_query("SELECT * FROM products WHERE `id`='$pid'") or die(mysql_error());

  $row = mysql_fetch_array($sql);

  $product_name = $row['product_name'];
  $price = $row['price'];
  $category = $row['category'];
  $subcategory = $row['subcategory'];
  $details = $row['details'];
  } else {
  echo "Nincs megjeleníthető termék.";
  // exit() nélkül fut tovább, és egy csomó hibaüzenetet tol az undefined variable-ök meg effélék miatt
  exit();
  }
 * 
 * 
 */

// KÖZÖS MEGOLDÁS
// ha paraméteres linkkel megyünk egy oldalra, akkor mindig az ellenőrzéssel kezdünk,
// hogy az adott kulcs benne van-e a GET szg tömbben

if (isset($_GET['id'])) {

    // most preg_replace-szel van kedvünk csinálni
    // ami nem szám, azt kicseréljük üresre, tehát töröljük
    // ^ a NEM jele
    $id = preg_replace("#[^0-9]#i", "", $_GET['id']);

    // praktikus a require, mert a termékekben semmi keresnivalónk, ha nincs id-nk a GET-ben
    // így ugye leáll a futás is hiba esetén
    require 'boltszkriptek/kapcsolat_a_mysqlhez.php';

    // lekérdezzük az adatbázisból a terméket id alapján    
    $sql = mysql_query("SELECT * FROM products WHERE `id`='$id' LIMIT 1");

    // megnézzük, van-e találatunk
    $megszamolom_a_sorokat = mysql_num_rows($sql);

    if ($megszamolom_a_sorokat > 0) {

        // ha van találat, akkor sorváltozóba teszem az adatot
        $row = mysql_fetch_array($sql);

        // kulcs alapján kiszedjük a row-ból az értékeket
        $product_name = $row['product_name'];
        $price = $row['price'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $details = $row['details'];
        
    } else {
        
        echo "A keresett termék nem található.<br/>";
        echo '<a href="index.php">Vissza</a>';
        exit();
    }
    
} else {
    echo "Nem létező vagy hiányzó azonosító.<br/>";
    echo '<a href="index.php">Vissza</a>';
    exit();
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
        <div align="center">
            <?php include './fejlec_sablon.php'; ?>
            <div id="pageContent">
                <table width="100%" cellspacing="0">
                    <tr>
                        <td width="19%" valign="top">
                            <img src="termekkepek/<?php echo $id; ?>.jpg" width="150" height="200" alt="<?php echo $product_name; ?>"/><br/><a href="termekkepek/<?php echo $id; ?>.jpg">Teljes méret</a>
                        </td>
                        <td width="81%" valign="top">
                            <h3><?php echo $product_name; ?></h3>
                            <p><?php echo $price; ?> Ft</p><br/>
                            <p><?php echo "$category - $subcategory"; ?></p>
                            <p><?php echo $details; ?></p><br/>
                            <form method="post" name="form1" action="kosar.php">
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
                                <input type="submit" name="submit" value="Kosárba"/>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <?php include './lablec_sablon.php'; ?>
        </div>
    </body>
</html>
