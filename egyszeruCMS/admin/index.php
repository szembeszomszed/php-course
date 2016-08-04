<?php
require '../include/konfiguracio.php';

// bizonyosodjunk meg arról, hogy valóban a jó felhasználó lépett-e be
loginNeeded();

// ha a felhasználó ki szeretne lépni, akkor
if (isset($_GET['logout'])) {
    logout();
}

// ha az url-t paraméterezzük, bekerül a $_GET-be, és le tudjuk kérdezni
// úgyhog most a paraméterezett url-t lekérdezzük a törlés végett

if(isset($_GET['delpage'])) {
    $delpage = $_GET['delpage'];
    
    //mivel url-ből nyerjük ki az infót, ezért meg kell tisztítani
    $delpage = mysql_real_escape_string($delpage);
    $sql = mysql_query("DELETE FROM pages WHERE `pageID` = '$delpage'");
    $_SESSION['success'] = "Oldal törölve";
    header('Location: '.DIRADMIN);
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
        <title>Admin - <?php echo OLDALFEJLEC;?></title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <script>
            // itt egy aranyos JavaScript-kódot is beleékelünk a felugró ablak kedvéért
            function delpage(id, title) {
                if (confirm('Biztos vagy benne, hogy törölni szeretnéd' + title + ' az oldalt?')) {
                    window.location.href = '<?php echo DIRADMIN;?>?delpage=' + id;
                }
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="logo">
                <a href="<?php echo DIR;?>" target="_blank">
                    <img src="http://placekitten.com/230/50" width="230" height="50" alt="<?php echo OLDALFEJLEC;?>" />
                </a>
            </div>
            <!-- Navigáció -->
            <div id="navigation">
                <ul class="menu">
                    <li><a href="<?php echo DIRADMIN; ?>">Admin</a></li>
                    <li><a href="<?php echo DIR; ?>">Oldal megtekintése</a></li>
                    <li><a href="<?php echo DIRADMIN; ?>?logout">Kilép</a></li>
                </ul>
            </div>
            <!-- Navigáció vége -->
            <!-- Tartalmi rész -->
            <div id="content">
                <?php 
                // ha bármilyen üzenetünk van, akkor jelenítsük meg
                messages();
                ?>
                <h1>Oldalak kezelése</h1>
                <table>
                    <tr>
                        <th><strong>Cím</strong></th>
                        <th><strong>Művelet</strong></th>
                    </tr>
                    <?php
                    // töltsük fel a táblázatot a mentett adatokkal
                    // először lekérdezünk rendezéssel egybekötve
                    $sql = mysql_query("SELECT * FROM pages ORDER BY `pageID`");
                     
                    // a lekérdezés eredményét sorokba rakjuk
                    // itt most fetch_objectet használunk a változatosság kedvéért
                    while ($row = mysql_fetch_object($sql)) {
                        echo '<tr>';
                        echo "<td>$row->pageTitle</td>"; // fetch_object miatt használjuk a kacsacsőrt
                        
                        // a főoldalra csak a szerkesztést rakjuk ki
                        // a törlés műveletet nem
                        
                        if ($row->pageID == 1) {
                            echo '<td><a href="szerkesztes.php?id='.$row->pageID.'">Szerkesztés</a></td>';
                        } else {
                            // minden más esetben az oldal nem főoldal, tehát törölhető
                            echo '<td><a href="szerkesztes.php?id='.$row->pageID.'">Szerkesztés</a> | ' . '<a href="javascript:delpage(\''.$row->pageID.'\',\''.$row->pageTitle.'\');">Törlés</a></td>';
                            // delpage('$row->pageID', '$row->pageTitle') ----> így kéne kinéznie
                            // csak az echózás meg mindenféle ''-ok használata miatt időnként a kilépő \-t is használni kell
                        }
                        echo '</tr>';
                    }
                    
                    ?>
                </table>
                <p><a href="<?php echo DIRADMIN;?>oldalhozzaadasa.php" class="button">Oldal hozzáadása</a></p>
            </div>
            <div id="footer">
                <div class=""><?php echo OLDALFEJLEC.' '. date('Y'); ?></div>
            </div>
        </div>
    </body>
</html>
