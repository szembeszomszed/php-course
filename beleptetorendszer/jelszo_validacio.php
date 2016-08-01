<?php

// munkamenet indítása
session_start();

// a hiba és a sikeres változók felvétele és alapérték-adása
$Error = '';
$successMessage = '';

// a submit gombra ráellenőrzünk, hogy be van-e állítva
if (isset($_POST['submit'])) {
    if (!($_POST['email'] == "" && $_POST['password'] == "")) { // megnézzük, hogy mindkét mező ki van-e töltve (nincs-e nemkitöltve:)
        $email = $_POST['email'];
        $password = sha1($_POST['password']); // a jelszót titkosított formában tárolom el a változóban
        
        // az email-címet leellenőrzöm és megtisztítom - az oda nem illő karaktereket kiszedem      
        $email = filter_var($email, FILTER_SANITIZE_EMAIL); 
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) { // az email-cím formátumának ellenőrzése - csak akkor megyünk tovább, ha jó
            // kapcsolat felépítése a szerverrel
            $connection = mysql_connect('localhost', 'root', '') or die(mysql_error());
            
            // db kiválasztása
            $db = mysql_select_db('loginrendszer', $connection);
            
            // lekérdezést írok, ami az email-címre és a jelszóra ellenőriz
            $result = mysql_query("SELECT * FROM registration WHERE email='$email' AND password='$password'") or die(mysql_error());
            
            // megszámolom a találatom sorait
            $data = mysql_num_rows($result);
            
            
            // csak akkor megyek tovább, ha a találatom sorainak száma egyenlő 1-gyel
            if ($data == 1) {
                
                // mivel session-t vizsgálok a belépést követően, ezért itt beállítom az értékeit
                $_SESSION['login_user'] = $email;
                header("location: profil.php"); // átirányítom a profiloldalára
            } else {
                $Error = "Email-cím vagy jelszó helytelen!";
            }
            
            // csatlakozás bezárása
            mysql_close($connection);
            
        } else {
            $Error = "Rossz az email-cím formátuma!";
        }
    } else {
        $Error = "Az email-cím vagy a jelszó nincs kitöltve!";
    }
}



