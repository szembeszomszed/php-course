<?php
require '../include/konfiguracio.php';

// bizonyosodjunk meg arról, hogy valóban a jó felhasználó lépett-e be
loginNeeded();

// mivel form lesz itt is, ezért ismét submitra ellenőrzünk
if (isset($_POST['submit'])) {
    $title = $_POST['pageTitle'];
    $content = $_POST['pageCont'];
    
    // tisztítás
    $title = mysql_real_escape_string($title);
    $content = mysql_real_escape_string($content);
    
    // beszúró, azaz INSERT lekérdezés futtatása
    mysql_query("INSERT INTO pages (`pageTitle`, `pageCont`) VALUES ('$title', '$content')") or die(mysql_error());
    
    // sikeres üzenet beállítása
    $_SESSION['session'] = "Oldal sikeresen hozzáadva.";
    
    // visszairányítjuk az adminfelületre
    header('Location: '.DIRADMIN);
    
    // futás leállítása
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
                    <img src="http://placekitten.com/230/30" width="230" height="50" alt="<?php echo OLDALFEJLEC; ?>" />
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
                <h1>Oldal hozzáadása</h1>

                <!-- a form action így önmagára mutat-->
                <!-- minden value-ba, illetve textareában a tagek közé beechózzuk az adatbázisban lévő adatokat-->
                <form action="" method="post">
                    <input type="hidden" value="" name="pageID"/>
                    <p>
                        Cím: <br/>
                        <input type="text" name="pageTitle" value=""/>                        
                    </p>
                    <p>
                        Tartalom: <br/>
                        <textarea name="pageCont" cols="100" rows="20"></textarea>
                        <!-- ide is bemásoljuk a ckeditor által adott scriptet, de átírjuk a replace-ben a mi textarea name-ünkre a paramétert-->
                        <script>
                            CKEDITOR.replace('pageCont');
                        </script>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Hozzáad" class="button"/>
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