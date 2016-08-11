<?php
// azokon az oldalakon, ahol/ahova beléptetés zajlik, mindig munkamenetet indítunk
// szóval itt is így teszünk

session_start();

// ha a $_SESSION manager kulcsa nincs beállítva, már küldjük is vissza az loginoldalra
if (!isset($_SESSION['manager'])) {
    header('Location: menedzselo_login.php');
    exit();
}

// tegyük a session értékeit változókba, és tisztítsuk is meg az oda nem illő karakterektől
// a ^ még mindig a NEM-et jelenti
// az i pedig kikapcsolja a kis- és nagybetűs érzékenységet
// id csak szám lehet, ezért van a 0-9
$managerID = preg_replace("#[^0-9]#i", '', $_SESSION['id']);
$manager = preg_replace("#[^A-Za-z0-9ÖÜÓŐÚÉÁŰÍöüóőúéáűí]#i", '', $_SESSION['manager']);
$password = preg_replace("#[^A-Za-z0-9ÖÜÓŐÚÉÁŰÍöüóőúéáűí]#i", '', $_SESSION['password']);

// csatlakozás
require '../boltszkriptek/kapcsolat_a_mysqlhez.php';

// lekérdezés
$sql = mysql_query("SELECT * FROM `admin` WHERE `id`='$managerID' AND `username`='$manager' AND `password`='$password' LIMIT 1") or die(mysql_error());

// nézzük meg, a felhasználó benne van-e az adatbázisban - ha nincs, akkor hibaüzenet
$letezikeszamolas = mysql_num_rows($sql);

if ($letezikeszamolas == 0) {
    echo '<h1 style="color: red">A munkamenet nincs benne az adatbázisban</h1>';
    exit();
}
?>

<?php
// KIZÁRÓLAG FEJLESZTÉS ALATT HASZNÁLJUK EZT ITT - TÖRLÉSE VAGY LEGALÁBB KIKOMMENTELÉSE KÖTELEZŐ
// az összes hiba megjelenítése az oldalon a következő kódsorozattal történik
// figyelem! az összes felmerülő hibát ezzel kijelezzük, ami nemcsak a kódolásra, de a szerver esetleges
// hibáira is felhívja a figyelmet, ha használjuk az adott erőforrást

error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
// MEGJELENÍTÉS
// először egy üres változó létrehozása
$termek_lista = "";

// sorba rendezve kérdezzük le a termékeket
// mégpedig a hozzáadás dátuma szerint csökkenő sorban
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC");

// megszámoljuk a sorokat, mert lehet olyan eset is, amikor nulla lesz az eredmény
// ami azt jelenti, hogy nincs termék feltöltve
$termekekSzama = mysql_num_rows($sql);

if ($termekekSzama > 0) {
    while ($row = mysql_fetch_array($sql)) {
        $id = $row['id'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $date_added = $row['date_added'];

        // formázva szeretnénk a dátumot kiíratni, de mivel egy string van a változóban
        // ezért át kell alakítani, és úgy formázni
        // a strtotime függvény azért működik hiba nélkül, mert az adatbázisban a date_added mező
        // valójában date formátum, csak változóba kerülve vált stringgé
        $date_added = strftime("%Y %b %d", strtotime($date_added));

        // hozzáfűzzük a változónkhoz a termékeket az alábbi módon
        // a szerkesztés és töröl gombnál paraméterezünk is, hogy rögtön az adott termékre mutasson (id alapján)
        $termek_lista .= "Termék ID: $id - <strong>$product_name</strong> - $price Ft - <em>Létrehozva: </em>$date_added | <a href='termekszerkesztes.php?pid=$id'>Szerkeszt</a> - <a href='termeklista.php?deleteid=$id'>Töröl</a><br/>";
    }
} else {
    $termek_lista = "Nincs megjeleníthető termék";
}
?>

<?php

// az űrlap adatait itt kiemelezzük
// ha a product_name be van állítva, elkezdhetjük a feldolgozást
if (isset($_POST['product_name'])) {
    // biztos, ami biztos, meg is tisztítjuk a beérkező cuccokat
    $pid = mysql_real_escape_string($_POST['thisID']);
    $product_name = mysql_real_escape_string($_POST['product_name']);
    $price = mysql_real_escape_string($_POST['price']);
    $category = mysql_real_escape_string($_POST['category']);
    $subcategory = mysql_real_escape_string($_POST['subcategory']);
    $details = mysql_real_escape_string($_POST['details']);
    var_dump($pid);
    
    // a termék a fentiek szerint szerepel az adatbázisban, ezért frissítjük azt
    $sql = mysql_query("UPDATE products SET product_name='$product_name', price='$price', category='$category', subcategory='$subcategory', details='$details' WHERE id='$pid'") or die(mysql_error());
    
    // csak akkor módosítjuk a képet, ha az átmeneti tárunk nem üres
    // mert ez ugye azt jelenti, hogy a user most feltöltött egy képet a termékszerkesztő formban
    // magyarul módosítani akarja a képet is
    // ha nem akarja (tehát nem tölt fel semmit), akkor nem írjuk felül a már létezőt
    if($_FILES['fileField']['tmp_name'] != "")
    $ujnev = "$pid.jpg";
    move_uploaded_file($_FILES['fileField']['tmp_name'], "../termekkepek/$ujnev");
    
    // átirányítás
    header('Location: termeklista.php');
    
    // futás leállítása
    exit();      
}
?>


<?php

if(isset($_GET['pid'])) {
    // cél ID változót veszünk föl, ebbe rakjuk a linkben érkező ID-t
    // persze tisztítunk is
    $celID = mysql_real_escape_string($_GET['pid']);
    $sql = mysql_query("SELECT * FROM products WHERE id='$celID' LIMIT 1") or die(mysql_error());
    $megszamolom_a_sorokat = mysql_num_rows($sql);
    
    // igazából ideális esetben 1 találatot kapunk
    if ($megszamolom_a_sorokat > 0) {
        $row = mysql_fetch_array($sql);
        $product_name = $row['product_name'];
        $price = $row['price'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $details = $row['details'];

        // a dátumot is kiszedjük az adatbázisból
        // de mivel az egy sima string, ezért előbb dátummá alakítjuk (strtotime())
        // majd meg is formázzuk (strftime());
        $date_added = strftime("%Y %b %d", strtotime($row['date_added']));
       
    } else {
        echo '<h3>Nincs megjeleníthető termék</h3>';
        exit();
    }    
    
} else {
    echo '<h2 align="center" style="color:red;">Nem választott ki terméket</h2>';
    echo '<a align="center" href="termeklista.php">Kattintson ide</a>';
    exit();
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Termék szerkesztése - Admin</title>
        <script src="ckeditor_4.5.10_full/ckeditor/ckeditor.js" type="text/javascript"></script>
        
    </head>
    <body>
        <div align="center">
            <!-- header -->
            <?php include '../fejlec_sablon.php'; ?>
            <!-- end of header -->
            <!-- content -->
            <div id="pageContent">
                <div align="right">
                    <!-- a #-tel lehet oldalon belüli linket létrehozni -->
                    <h2><a href="termeklista.php#ujtermekform">+ Új termék hozzáadása +</a></h2>
                </div> 
                <div align="left">
                    <h2>Terméklista</h2>
            <?php echo $termek_lista; ?>
                </div>
                <hr/>
                <a name="ujtermekform" id="ujtermekform"></a>
                <h3>Termék szerkesztése</h3>
                <!-- FONTOS -->
                <!-- ha a formba nem írjuk be az encoding type-ot, akkor a fájl mentése soha nem fog sikerülni -->
                <!-- formája enctype="multipart/form-data" -->
                <!-- ügyelni kell a form action-jére, hogy jó helyre mutasson -->
                <form action="termekszerkesztes.php" method="post" enctype="multipart/form-data" name="sajatForm">
                    <table width="90%" cellpadding="5">
                        <tr>
                            <td width="20%">Termék neve</td>
                            <td width="80%">
                                <label>
                                    <input name="product_name" type="text" id="product_name" value="<?php echo $product_name;?>"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Termék ára: </td>
                            <td>
                                <label>
                                    <input name="price" type="text" id="price" value="<?php echo $price;?>"/> Ft
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Kategória: </td>
                            <td>
                                <label>
                                    <select name="category" id="category">
                                        <option name="Ruha">Ruha</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Alkategória: </td>
                            <td>
                                <label>
                                    <select name="subcategory" id="subcategory">
                                        <!-- mivel selectnél defaultként mindig az első jelenik meg,
                                        becsűrünk ide még egy sort, és abba echozzuk az adatbázisból szedett subcategoryt-->
                                        <!-- persze ennek a hátránya, hogy így kétszer szerepel majd a dropdownban az adott kategória-->
                                        <option name="fromdb"><?php echo $subcategory; ?></option>
                                        <option name="Kalap">Kalap</option>
                                        <option name="Zokni">Zokni</option>
                                        <option name="Polo">Póló</option>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Termékadatok: </td>
                            <td>
                                <label>
                                    <textarea name="details" id="details" ><?php echo $details; ?></textarea>
                                    <script>
                                         CKEDITOR.replace('details');
                                    </script>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <!-- fájl feltöltése -->
                            <td>Termékképek: </td>
                            <td>
                                <label>
                                    <input type="file" name="fileField" id="fileField"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>
                                <label>
                                    <!-- ide egy rejtett mezőbe felvesszük a thisID nevet, amire feljebb hivatkozunk-->
                                    <input type="hidden" name="thisID" value="<?php echo $celID;?>"/>
                                    <input type="submit" name="submit" value="Szerkesztés"/>
                                </label>
                            </td>
                        </tr>                        
                    </table>                    
                </form>
            </div>
            <!-- end of content -->
            <!-- footer -->
            <?php include '../lablec_sablon.php';?>
            <!-- end of footer -->
        </div>       

    </body>
</html>
