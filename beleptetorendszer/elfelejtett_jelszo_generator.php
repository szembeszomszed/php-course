<?php

// a használt változók létrehozása és alapérték-adása
$email = "";
$Error = "";
$successMessage = "";

// az űrlap feldolgozása submit ellenőrzésével kezdődik
// egyébként lehet olyan mezőre is, amit mindenképpen ki kell tölteni
if (isset($_POST['submit'])) {
    // ellenőrizzük le, hogy ki van-e töltve az email-cím mezeje
    if (!($_POST['email'] == "")) {

        // az ágba csak akkor lépünk be, ha van érték az email-mezőben
        $email = $_POST['email'];

        // az email-címünkből az oda nem illő karaktereket ki kell szedni
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // ha az email-cím formátuma valós, csak akkor lépünk tovább
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // jelszógenerálás
            $karakterek = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz%#*!_';
            $password = substr(str_shuffle($karakterek), 0, 8);

            // jelszó titkosítása egy új változóban
            $password1 = sha1($password);

            // csatlakozás a szerverhez
            $connection = mysql_connect('localhost', 'root', '');

            // adatbázis kiválasztása
            $db = mysql_select_db("loginrendszer", $connection);

            // frissítő lekérdezés futtatása az adatbázison
            // itt azt is megnézzük, létezik-e már az email-cím
            $query = mysql_query("UPDATE registration SET password='$password1' WHERE email = '$email'") or die(mysql_error());

            if ($query) {
                $to = $email;
                $subject = "Az ön módosított jelszava";

                // ha a regisztrációról írunk emailt, célszerű sima szöveg (text) kiküldése
                // hanyagoljuk a HTML tageket, mivel az növeli a spamscore mutatót
                $message = "Hello!"
                        . "Az ön jelszava elkészült."
                        . "A belépéshez használható email-cím: $email"
                        . "Az ön módosított jelszava: $password."
                        . "Most már beléphet az oldalra."
                        . "Üdvözlettel: Mekk Elek" // fontos az aláírás, mert különben jó eséllyel spamnek lesz titulálva
                        . "Az ön beleegyezése nélkül nem küldünk ki több emailt önnek";
                
                // a levélküldéshez a beépített mail() függvényt használjuk (lokálisan xampp alatt nem működik, mivel nincs beállítva)
                if (mail($to, $subject, $message)) {
                    $successMessage = "Az új jelszavát tartalmazó emailt kiküldtük önnek.";
                }
            }
            
        } else {
            $Error = "Az email-cím nem valós.";
        }
        
    } else {
        $Error = "Az email-cím megadása kötelező.";
    }
}

