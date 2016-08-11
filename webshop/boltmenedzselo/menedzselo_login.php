<?php
// munkamenet indítása
session_start();

// ellenőrizzük le, hogy a menedzser benne van-e a munkamenetben
// ha igen, akkor rögtön átdobjuk az adminoldalra
if (isset($_SESSION['manager'])) {
    header('Location: index_sajat.php');
    exit();
}

// ha a belépő oldalon maradtunk, akkor le kell ellenőrizni a username-et és a passwordöt
if (isset($_POST['username']) && isset($_POST['password'])) {

    // tisztítás - ezúttal preg_replace-szel a változatosság kedvéért
    // a ^ azt jelenti, hogy NEM
    // a reguláris kifejezés nem csak /-rel nyitható, hanem #-tel is
    // az i kikapcsolja a case sensitive-itást
    $manager = preg_replace("#[^A-Za-z0-9ÖÜÓŐÚÉÁŰÍöüóőúéáűí]#i", '', $_POST['username']);
    $password = preg_replace("#[^A-Za-z0-9ÖÜÓŐÚÉÁŰÍöüóőúéáűí]#i", '', $_POST['password']);

    // csatlakozás az adatbázishoz
    include '../boltszkriptek/kapcsolat_a_mysqlhez.php';

    // kérdezzük le a belépő személyt
    $sql = mysqli_query($dblink, "SELECT id FROM `admin` WHERE username='$manager' AND password='$password' LIMIT 1");

    // ellenőrzés (ami egyébként itt már elhagyható)
    $letezikeszamolas = mysqli_num_rows($sql);

    if ($letezikeszamolas == 1) {
        $row = mysqli_fetch_array($sql);
        $id = $row['id'];

        // ha minden rendben van, akkor beállíthatjuk a session kulcsokat
        $_SESSION['id'] = $id;
        $_SESSION['manager'] = $manager;
        $_SESSION['password'] = $password;

        // beállítás után átdobjuk az adminoldalra
        header('Location: index_sajat.php');
        exit();
        
    } else {
        // ha nem lépett be az if-ágba, akkor itt hibát íratunk ki
        echo 'A megadott adatok helytelenek. Kérem, kattintson <a href="./menedzselo_login.php">IDE</a>';
        exit();
    }
}
?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Webshop Admin Login</title>
    </head>
    <body>
        <div align="center">
            <!-- header -->
            <?php include '../fejlec_sablon.php';?>
            <!-- end of header -->
            <!-- content -->
            <div id="pageContent">
                <div align="left">
                    <h2>Kérem, jelentkezzen be!</h2>
                    <form name="form1" action="menedzselo_login.php" method="post">
                        Felhasználónév:<br/>
                        <input type="text" name="username"/>
                        <br/><br/>
                        Jelszó: <br/>
                        <input type="password" name="password"/>
                        <br/><br/><br/>
                        <input type="submit" name="submit" value="Belépés"/>
                    </form>
                </div>                       
            </div>
            <!-- end of content -->
            <!-- footer -->
            <?php include '../lablec_sablon.php';?>
            <!-- end of footer -->
        </div>        
    </body>
</html>
