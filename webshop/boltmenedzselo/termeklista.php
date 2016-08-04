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
$sql = mysqli_query($dblink, "SELECT * FROM `admin` WHERE `id`='$managerID' AND `username`='$manager' AND `password`='$password' LIMIT 1") or die(mysql_error($dblink));

// nézzük meg, a felhasználó benne van-e az adatbázisban - ha nincs, akkor hibaüzenet
$letezikeszamolas = mysqli_num_rows($sql);

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
// TÖRLÉSRE VALÓ RÁKÉRDEZÉS
// az url-ből a GET szg tömbbe kerül kulcs és érték alapján az id, amire ráellenőrzünk jó igényesen
// így fogunk pl törölni terméket
// élesben az url-re írt kulcsok nevei se legyenek beszédesek - ajánlott a betűk és számok random kombinációja (6-8 karakter)
if (isset($_GET['deleteid'])) {
    echo '<h2>Valóban törölni szeretnéd a terméket, amelynek azonosítója: ' . $_GET['deleteid'] . '? <br/>'
    . ' <a href="termeklista.php?igentorol=' . $_GET['deleteid'] . '">Igen</a> | '
    . '<a href="termeklista.php">Nem</a>';
    exit();
}
?>

<?php
// TERMÉK TÖRLÉSE
// nézzük meg, hogy az igentorol be van-e állítva
if (isset($_GET['igentorol'])) {
    $id_a_torleshez = $_GET['igentorol'];

    // törüljük a terméket a hozzátartozó majdani fotóval együtt
    $sql = mysqli_query($dblink, "DELETE FROM products WHERE id='$id_a_torleshez' LIMIT 1") or die(mysql_error($dblink));

    // kép törlése a szerverről
    // a kép nevének és útvonalának változóba helyezése
    $kep_a_torleshez = "../termekkepek/$id_a_torleshez.jpg";

    // ha létezik a szerveren ilyen kép, akkor törlünk
    if (file_exists($kep_a_torleshez)) {
        // törlés
        unlink($kep_a_torleshez);
    }

    //visszairányítjuk a terméklistához
    header('Location: termeklista.php');

    // futás leállítása
    exit();
}
?>

<?php
// ÚJ TERMÉK FELVITELE
// ki kell elemezni a formból kapott információkat
// adminon belül nem kötelező a submitra történő ellenőrzés, hiszen másra is ráellenőrizhetünk
// most így is teszünk

if (isset($_POST['product_name'])) {

    // form adatait megtisztítjuk, és változókba helyezzük
    $product_name = mysqli_real_escape_string($dblink, $_POST['product_name']);
    $price = mysqli_real_escape_string($dblink, $_POST['price']);
    $category = mysqli_real_escape_string($dblink, $_POST['category']);
    $subcategory = mysqli_real_escape_string($dblink, $_POST['subcategory']);
    $details = mysqli_real_escape_string($dblink, $_POST['details']);

    // megnézzük, létezik-e már a termék az adatbázisban
    // persze ha elgépeli a user, akkor nemigen tudunk mit tenni    
    $sql = mysqli_query($dblink, "SELECT * FROM products WHERE product_name='$product_name' LIMIT 1") or die(mysqli_error($dblink));

    // megnézzük, hány találat akad
    $vaneilyen = mysqli_num_rows($sql);

    // egyezés (tehát találat) esetén jön a hibaüzenet
    if ($vaneilyen > 0) {
        echo '<h3> A termék már szerepel az adatbázisban</h3><br/>Kattintson <a href="termeklista.php">IDE</a>';

        // futás leállítása
        exit();
    }

    // ha nem léptünk az if-ágba, akkor minden zsír, a termék még nem létezik az adatbázisban
    // termék mentése lekérdezés nyomán
    $sql = mysqli_query($dblink, "INSERT INTO products(`product_name`, `price`, `details`, `category`, `subcategory`, `date_added`) VALUES ('$product_name', '$price', '$details', '$category', '$subcategory', now())") or die(mysqli_error($dblink));

    // a legutolsó lekérdezésem (beszúrás) id-ját egyszerű módon el tudom menteni egy változóba
    // ezt aztán hasznosítani fogjuk
    $pid = mysqli_insert_id($dblink);
    var_dump($pid);

    // a képet is le kell tárolni a megfelelő helyre
    // a kép neve
    $ujnev = "$pid.jpg";
    var_dump($ujnev);

    // a fájlfeltöltő input mező alapértelmezésként egy átmeneti tárba helyezi a fájlokat, 
    // amit nekem ebből az átmeneti tárból át kell helyeznem a végleges helyére, az új nevével
    // a move_uploaded_file-nak két paramétere van: honnan, hova. 
    // a honnan lesz az átmeneti helye a fájlnak. 
    // a fájl alapértelmezésként a $_FILES szg tömbbe kerül
    // melynek formája $_FILES['mezőneve']['tmp_name'] -> tömbök tömbje, ahol a tmp_name az átmeneti tár neve
    move_uploaded_file($_FILES['fileField']['tmp_name'], "../termekkepek/$ujnev");

    // visszaküldjük
    header('Location: termeklista.php');

    // futás leáll
    exit();
}
?>

<?php
// MEGJELENÍTÉS
// először egy üres változó létrehozása
$termek_lista = "";

// sorba rendezve kérdezzük le a termékeket
// mégpedig a hozzáadás dátuma szerint csökkenő sorban
$sql = mysqli_query($dblink, "SELECT * FROM products ORDER BY date_added DESC") or die(mysqli_error($dblink));

// megszámoljuk a sorokat, mert lehet olyan eset is, amikor nulla lesz az eredmény
// ami azt jelenti, hogy nincs termék feltöltve
$termekekSzama = mysqli_num_rows($sql);
//var_dump($termekekSzama);

if ($termekekSzama > 0) {
    while ($row = mysqli_fetch_array($sql)) {
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


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Terméklista - Admin</title>
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
                <h3>Új hozzáadása</h3>
                <!-- FONTOS -->
                <!-- ha a formba nem írjuk be az encoding type-ot, akkor a fájl mentése soha nem fog sikerülni -->
                <!-- formája enctype="multipart/form-data" -->
                <form action="termeklista.php" method="post" enctype="multipart/form-data" name="sajatForm">
                    <table width="90%" cellpadding="5">
                        <tr>
                            <td width="20%">Termék neve</td>
                            <td width="80%">
                                <label>
                                    <input name="product_name" type="text" id="product_name"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Termék ára: </td>
                            <td>
                                <label>
                                    <input name="price" type="text" id="price"/> Ft
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
                                    <textarea name="details" id="details"></textarea>
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
                                    <input type="submit" name="submit" value="Felvitel"/>
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
