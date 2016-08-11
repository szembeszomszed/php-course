<?php

/* ÉN MEGOLDÁSOM
require 'boltszkriptek/kapcsolat_a_mysqlhez.php';
$sql = mysql_query("SELECT * FROM products ORDER BY date_added ASC LIMIT 3") or die(mysql_error());

$numberOfRows = mysql_num_rows($sql);

if ($numberOfRows > 0) {
    $dinamikusLista = '<table border="1" style="border-collapse:collapse;">'
            . '<tr>'
            . '<th>Termék neve</th>'
            . '<th>Termék ára</th>'
            . '<th height="50" width="50">Fotó</th>'
            . '</tr>';
    
    while ($row = mysql_fetch_assoc($sql)) {
        $dinamikusLista .= '<tr>'
                . '<td><a href="#">'.$row["product_name"].'</a></td>'
                . '<td>'.$row["price"].' Ft</td>'
                . '<td height="50" width="50"><img style="display:block;" width="100%" height="100%" src="./termekkepek/'.$row["id"].'.jpg"/></td>'
                . '</tr>';
        
    }
    $dinamikusLista .= '</table>';
} else {
    $dinamikusLista = "Nincs megjeleníthető termék";
}
 * 
 * 
 */

// KÖZÖS MEGOLDÁS

error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php

include 'boltszkriptek/kapcsolat_a_mysqlhez.php';
$dinamikusLista = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 6");
$megszamolom_a_sorokat = mysql_num_rows($sql);
if ($megszamolom_a_sorokat > 0) {
    while ($row = mysql_fetch_array($sql)) {
        $id = $row['id'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $date_added = strftime('%Y %b %d', strtotime($row['date_added']));
        
        // itt most gyakorlatilag külön táblázatot hozunk létre mindegyik terméknek
        $dinamikusLista .= '<table width="100%" cellspacing="0">'
                . '<tr>'
                . '<td width="20%" valign="top"><a href="termek.php?id='.$id.'">'
                . '<img src="termekkepek/'.$id.'.jpg" alt="'.$product_name.'" width="80" height="100"></a></td>'
                . '<td width="80%" valign="top">'.$product_name.'<br/>'.$price.' Ft<br/>'
                . '<a href="termek.php?id='.$id.'">Termékadatok megtekintése</a></td></tr></table>';
    }
} else {
    $dinamikusLista = "Nincs megjeleníthető termék";
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
        <title>Webshop Főoldal</title>
    </head>
    <body>
        <div align="center">
            <?php include './fejlec_sablon.php'; ?>
            <!-- content -->
            <div id="pageContent">
                <table width="100%" cellspacing="0" cellpadding="5">
                    <tr>
                        <td width="32%" valign="top">
                            <h3>Lorem Ipsum</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <p>
                                Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. 
                            </p>
                            <p>
                                Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. In convallis tellus a mauris. Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo. In hac habitasse platea dictumst. Vivamus facilisis diam at odio. Mauris dictum, nisi eget consequat elementum, lacus ligula molestie metus, non feugiat orci magna ac sem. 
                            </p>                            
                        </td>
                        <td width="35%" valign="top">
                            <h3>Funce convallis, mauris</h3>
                            <p><?php echo $dinamikusLista; ?><br/></p>
                        </td>
                        <td width="33%" valign="top">
                            <p>Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo.</p>   
                        </td>
                    </tr>
                </table>
            </div>
            <!-- end of content -->
            <?php include './lablec_sablon.php'; ?>
        </div>
    </body>
</html>
