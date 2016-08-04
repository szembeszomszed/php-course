<?php
require '../include/konfiguracio.php';

// bizonyosodjunk meg arról, hogy valóban a jó felhasználó lépett-e be
loginNeeded();

// le kell ellenőrizni a linkben kapott id-t, hogy benne van-e a GET szg tömbben,
// és be van-e állítva az értéke
if (!isset($_GET['id']) || $_GET['id'] == '') {
    //ha nincs beállítva, vagy az id értéke üres, akkor visszairányítjuk az adminoldalra
    header('Location: ' . DIRADMIN);
}

// ha űrlapunk van az oldalon, akkor submitra ellenőrzünk
// márpedig mivel ez egy szerkesztőfelület lesz, itt bizony egy űrlappal biztosítjuk a felhasználói élményt

if (isset($_POST['submit'])) {
    // ki van töltve az űrlap, tehát az értékeket kiszedhetem változókba
    $title = $_POST['pageTitle'];
    $content = $_POST['pageCont'];
    // a pageID-t getből is kiszedhetnénk, de inkább a formból szedjük ki - és a formban ez egy rejtett mező lesz majd
    // ily módon megtisztítani sem kell
    $pageID = $_POST['pageID'];

    // hiába adminfelület, itt is meg kell tisztítani az inputot
    // vannak vírusok, melyek a böngészőben futva teleírkálják a formokat

    $title = mysql_real_escape_string($title);
    $content = mysql_real_escape_string($content);

    // az adatok frissítése az adatbázisban
    mysql_query("UPDATE pages SET `pageTitle`='$title', `pageCont`='$content' WHERE `pageID`='$pageID'") or die(mysql_error());

    $_SESSION['success'] = "Oldal frissítése megtörtént.";

    header('Location: ' . DIRADMIN);

    exit();
}
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Oldal szerkesztése <?php echo OLDAFEJLEC; ?></title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <!-- a ckeditort letöltjük, kicsomagoljuk, a mappáját bemásoljuk a source file-okba, majd behúzzuk ide a scriptet-->
        <!-- nem muszáj minden funkciót benne hagyni a letöltött szerkesztőben, úgyhogy eleve úgy töltsük le, hogy amit nem akarunk a usernek engedélyezni (pl fájlfeltöltés), az ne legyen benne a csomagban -->
        <script src="../ckeditor/ckeditor.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="logo">
                <a href="<?php echo DIR; ?>" target="_blank">
                    <img src="http://placekitten.com/230/30" width="230" height="30" alt="<?php echo OLDALFEJLEC; ?>" />
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
                <h1>Oldal szerkesztése</h1>
                <?php
                // végül mégis url-ből szedjük ki az id-t
                $id = $_GET['id'];
                // így viszont tisztítani is kell
                $id = mysql_real_escape_string($id);

                // megvan az id, szóval indítjuk a lekérdezést
                // eleve úgy írjuk meg, hogy 1-re limitálja a találatok számát
                $query = mysql_query("SELECT * FROM pages WHERE `pageID`='$id' LIMIT 1");

                $row = mysql_fetch_object($query);
                ?>

                <!-- a form action így önmagára mutat-->
                <!-- minden value-ba, illetve textareában a tagek közé beechózzuk az adatbázisban lévő adatokat-->
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $row->pageID; ?>" name="pageID"/>
                    <p>
                        Cím: <br/>
                        <input type="text" name="pageTitle" value="<?php echo $row->pageTitle; ?>"/>                        
                    </p>
                    <p>
                        Tartalom: <br/>
                        <textarea name="pageCont" cols="100" rows="20"><?php echo $row->pageCont; ?></textarea>
                        <!-- ide is bemásoljuk a ckeditor által adott scriptet, de átírjuk a replace-ben a mi textarea name-ünkre a paramétert-->
                        <script>
                            CKEDITOR.replace('pageCont');
                        </script>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Módosít" class="button"/>
                        <!-- a mégse gombot csak én csűrtem oda-->
                        <a href="<?php echo DIRADMIN ?>">Mégse</a>

                    </p>
                </form>
            </div>
            <div id="footer">
                <div class=""><?php echo OLDALFEJLEC . ' ' . date('Y'); ?></div>
            </div>
        </div>
    </body>
</html>
