<?php

// a használt változók felvétele és alapérték-adása
$name = "";
$email = "";
$nameError = "";
$emailError = "";
$successMessage = "";
$passwordMessage = "";

// leellenőrizzük, hogy be van-e állítva a submit
if (isset($_POST['submit'])) {
    
    // ha a név mezőm nem üres, akkor továbbmehetek    
    if (!($_POST['name'] == "")) {
        $name = $_POST['name'];
        
        // ellenőrizzük le, hogy csak kis- és nagybetűk, valamint szóköz van-e benne
        // csak akkor megyünk tovább, ha a név jó karaktereket tartalmaz
        // reguláris kifejezésekkel fogjuk mindezt megtenni
        if (preg_match("/[a-zA-ZöüóőúéáűíÖÜÓŐÚÉÁŰÍ ]/", $name)) {
            if (!($_POST['email'] == "")) {
                
                // ha az email-mező nem üres, akkor az értékét változóba teszem
                $email = $_POST['email'];
                
                // az oda nem illő karaktereket eltávolítom az email-címből
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                
                // csak akkor megyek tovább, ha az email-cím formátuma megfelelő
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
                    
                    // kérdezzük le email alapján, hogy az adatbázisban van-e már ilyen entry
                    $result = mysql_query("SELECT * FROM  registration WHERE email='$email'");
                    
                    // számoljuk meg a találatunk sorait
                    $data = mysql_num_rows($result);
                    
                    // ha a talált sorok száma nulla, az email-cím még nincs benne az adatbázisban, tehát továbbléphetünk
                    if ($data == 0) {
                        
                        // be kell illeszteni az új regisztrálót az adatbázisba
                        // FONTOS!! a kódolt jelszót kell lementeni, ami itt a $password1
                        $query = mysql_query("INSERT INTO registration (`name`, email, password) VALUES ('$name', '$email', '$password1')") or die(mysql_error());
                        
                        // ha a lekérdezés sikeresen lefut, akkor összeállítjuk a küldendő emailt
                        if ($query) {
                            $to = $email;
                            $subject = "Az ön jelszava";
                            
                            // ha a regisztrációról írunk emailt, célszerű sima szöveg (text) kiküldése
                            // hanyagoljuk a HTML tageket, mivel az növeli a spamscore mutatót
                            $message = "Hello $name!"
                                . "Az ön jelszava elkészült."
                                . "A belépéshez használható email-cím: $email"
                                . "Az ön jelszava: $password."
                                . "Most már beléphet az oldalra."
                                . "Üdvözlettel: Mekk Elek" // fontos az aláírás, mert különben jó eséllyel spamnek lesz titulálva
                                . "Az ön beleegyezése nélkül nem küldünk ki több emailt önnek";
                                    
                        }  
                        
                    } else {
                        $emailError = "A megadott email szerepel az adatbázisban. Használja az elfelejtett jelszó funkciót!";
                    }
                    
                } else {
                    $emailError = "Kérem, valós email-címet adjon meg!";
                }
                
            } else {
                $emailError = "Email-cím megadása kötelező!";
            }
            
        } else {
            $nameError = "Csak betű- és szóközkarakterek megengedettek";
        }
        
    } else {
        $nameError = "Név megadása kötelező.";
    }
}

