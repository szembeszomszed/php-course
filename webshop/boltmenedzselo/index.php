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
// a második paraméter a 'mire', jelen esetben: semmire
$managerID = preg_replace("#[^0-9]#i", '', $_SESSION['id']);
$manager = preg_replace("#[^A-Za-z0-9ÖÜÓŐÚÉÁŰÍöüóőúéáűí]#i", '', $_SESSION['manager']);
$password = preg_replace("#[^A-Za-z0-9ÖÜÓŐÚÉÁŰÍöüóőúéáűí]#i", '', $_SESSION['password']);

/*
var_dump($managerID);
var_dump($manager);
var_dump($password);
*/

// csatlakozás
require '../boltszkriptek/kapcsolat_a_mysqlhez.php';

// lekérdezés
$sql = mysqli_query($dblink, "SELECT * FROM `admin` WHERE `id`='$managerID' AND `username`='$manager' AND `password`='$password' LIMIT 1") or die(mysqli_error($dblink));

// nézzük meg, a felhasználó benne van-e az adatbázisban - ha nincs, akkor hibaüzenet
$letezikeszamolas = mysqli_num_rows($sql);
//var_dump($letezikeszamolas);


if ($letezikeszamolas == 0) {
    echo '<h1 style="color: red">A munkamenet nincs benne az adatbázisban</h1>';
    exit();
}


?>




<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Webshop Admin Page</title>
    </head>
    <body>
         <div align="center">
            <!-- header -->
            <?php include '../fejlec_sablon.php';?>
            <!-- end of header -->
            <!-- content -->
            <div id="pageContent">
                <div align="left">
                    <h2>Üdvözlöm az adminfelületen!</h2>
                    <p>
                        <a href="termeklista.php">Termék kezelése</a>
                        <a href="">Oldalak kezelése</a>
                    </p>
                </div>                       
            </div>
            <!-- end of content -->
            <!-- footer -->
            <?php include '../lablec_sablon.php';?>
            <!-- end of footer -->
        </div>       

    </body>
</html>
