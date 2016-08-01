<?php

// a létrehozott session fájlomat include-olom
include './session.php';

// a használt változókat alaphelyzetbe állítom
$Error = "";
$successMessage = "";

// submitra ellenőrzök itt is
if(isset($_POST["submit"])) {
    //csak akkor mehetek tovább, ha a mezőkben van érték
    if (!($_POST['newpassword'] == "" && $_POST['cnewpassword'] == "")) {        
        
        // kiszedem a változóból az értékeket        
        $newpassword = $_POST['newpassword'];
        $cnewpassword = $_POST['cnewpassword'];
        
        // most megnézem, egyezik-e a két jelszó
        if ($newpassword == $cnewpassword) {
            // kódolva eltárolom valamelyiket egy változóban - mindegy, melyiket
            $password = sha1($cnewpassword);
            
            // jöhet a csatlakozás
            $connection = mysql_connect("localhost", "root", "");
            
            // majd az adatbázis kiválasztása
            $db = mysql_select_db("loginrendszer", $connection);
            
            // lekérdezést írok az adatok frissítésére
            $query = mysql_query("UPDATE  registration SET password='$password' WHERE password='$login_password'") or die(mysql_error());
            
            // ha a lekérdezés sikeresen lefut, akkor kiíratunk egy üzenetet
            if ($query) { // ez azért kell, mert élesben a die()-okat kiszedjük, és így tudjuk ellenőrizni, hogy minden ok-e
                $successMessage = "A jelszó sikeresen módosítva.";
            }
            
        } else {
            $Error = "A jelszavak nem egyeznek.";
        }
        
    } else {
        $Error = "A jelszó nem lehet üres.";
    }
}

