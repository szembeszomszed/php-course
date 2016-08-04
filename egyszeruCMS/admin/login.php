<?php
// az eljárások-fájlt külön nem tudnám használni, ezért a konfigot csűröm be ide
// a require és az include között a különbség az, hogy ha nem sikerül a beillesztés, a require leállít mindent, míg az include hibajelzéssel ugyan, de fut tovább
require '../include/konfiguracio.php';

// megnézzük, be van-e már jelentkezve
// mert ha igen, akkor egyből átirányítjuk az admin-oldalra
// és itt meghívjuk éppen ezért a loggedIn() eljárást
if (loggedIn()) {
    header('Location: ' . DIRADMIN);
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Bejelentkezés <?php echo OLDALFEJLEC; ?></title>
        <!-- ha a CSS nem látszik, akkor url-lel is megadhatjuk - itt most mindkét megoldást becsűrjük, hátha működik legalább az egyik-->
        <link href="<?php echo DIR; ?>css/login.css" rel="stylesheet" type="text/css"/>
        <link href="../css/login.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="lwidth">
            <div class="page-wrap">
                <div class="content">
                <?php
                // belépés lekezelése
                if(isset($_POST['submit'])) {
                    // meghívjuk a létrehozott login($user, $pass) eljárásunkat
                    login($_POST['username'], $_POST['password']);
                }
                ?>

                    <div>
                        <p><?php echo messages(); ?></p>
                        <form method="post" action="">
                            <p> <!-- az új html-szabványok megkövetelik az alap html-tagek használatát formon belül, és a labelek használatát is, hiszen a felolvasó programok a label-t figyelik -->
                                <label>Felhasználónév</label>
                                <input type="text" name="username"/>
                            </p>
                            <p>
                                <label>Jelszó</label>
                                <input type="password" name="password"/>
                            </p><br/>
                            <input type="submit" name="submit" value="Belépés"/>
                        </form>
                    </div>
                </div><!-- content zárótag -->
            </div><!-- page-wrap zárótag -->
            <div class="footer">
                <?php echo OLDALFEJLEC.' '. date('Y');?>
            </div>
        </div>
    </body>
</html>
