<?php
require './include/konfiguracio.php';
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
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="logo">
                <a href="<?php echo DIR; ?>" target="_blank">
                    <img src="http://placekitten.com/230/30" width="230" height="30" alt="<?php echo OLDALFEJLEC; ?>" />
                </a>
            </div>
            <!-- Navigáció kezdete -->
            <div id="navigation">
                <ul class="menu">
                    <!-- a főoldal ugye nem törölhető, így azt külön visszük fel -->
                    <li><a href="<?php echo DIR; ?>">Főoldal</a></li>
                    <?php
                    // lekérdezést írok a nem-főoldalakra, azaz, ahol az isRoot=1
                    $sql = mysql_query("SELECT * FROM pages WHERE `isRoot`='1'") or die(mysql_error());

                    // mivel elvileg több találat lesz, ciklust használunk
                    while ($row = mysql_fetch_object($sql)) {
                        echo '<li><a href="' . DIR . '?page=' . $row->pageID . '">' . $row->pageTitle . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- Navigáció vége -->
            <!-- Tartalmi rész kezdete -->
            <div id="content">
                <?php
                // Ellenőrizzük le, hogy be van-e állítva a page-kulcs, mert ha nincs, akkor a főoldalt kell először betölteni
                if (!isset($_GET['page'])) {

                    // főoldal töltése, ha nincs beállítva page-kulcs
                    // lekérdezést írunk a főoldalra
                    $sql = mysql_query("SELECT * FROM pages WHERE `pageID`='1'") or die(mysql_error());
                    
                } else {

                    // azaz ha van a GET szg-tömbben pageid
                    $id = $_GET['page'];
                    // tisztítás
                    $id = mysql_real_escape_string($id);

                    // lekérdezést írunk a többi aloldalhoz
                    $sql = mysql_query("SELECT * FROM pages WHERE `pageID`='$id'") or die(mysql_error());
                }

                // a lekérdezés eredményét sorba rakjuk (bármely if-ágból jöjjön is)
                $row = mysql_fetch_object($sql);

                // megjelenítjük a kapott értékeket
                echo "<h1>{$row->pageTitle}</h1>";
                echo $row->pageCont;
                ?>        
            </div>
            <!-- tartalmi rész vége -->
            <!-- footer kezdete -->
            <div id="footer">
                <div class=""><?php echo OLDALFEJLEC . ' ' . date('Y'); ?></div>
            </div>
            <!-- footer vége -->
        </div>
        <!-- wrapper vége -->
    </body>
</html>
