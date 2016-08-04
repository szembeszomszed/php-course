<?php

// a BENNEVANE konstans ellenőrzésével kezdünk
// ha nincs definiálva  (abban a fájlban, ahol ezt a fájlt futtatjuk), akkor jön a hibaüzenet
if (!defined('BENNEVANE')) {
    die('<h1>El a kezekkel a fájltól!</h1>');
}

// a tartalomkezelő rendszerben használt eljárásokat itt egyben megírom
// felhasználó belépése-eljárás
function login($user, $pass) {
    // a változókat meg kell tisztítani, hogy az adatbázisba ne kerüljön be oda nem illő karakter vagy kód
    // a strip_tags kiszedi a html és php-kódokat
    // a mysql_real_escape_string hasonlót csinál
    $user = strip_tags(mysql_real_escape_string($user));
    $pass = strip_tags(mysql_real_escape_string($pass));

    // a kapott jelszót md5 titkosítási algoritmussal letároljuk
    $pass = md5($pass);

    // leellenőrizzük, hogy a felhasználónév és a jelszó szerepel-e az adatbázisban
    $sql = "SELECT * FROM members WHERE username='$user' AND password='$pass'";
    $result = mysql_query($sql) or die('Hibás lekérdezés, mert: ' . mysql_error());

    // csak akkor lépünk tovább, ha a lekérdezés sorai 1-et adnak vissza
    if (mysql_num_rows($result) == 1) {

        // a felhasználónév és a jelszó egyezik, tehát mehetünk tovább
        // állítsuk be a sessiont
        $_SESSION['authorized'] = true;

        // átirányíthatjuk az admin oldalra
        header('Location: ' . DIRADMIN);

        // kilépünk eme script futásából
        exit();
    } else {

        // hibát íratunk a sessionbe
        $_SESSION['error'] = "Rossz felhasználónév vagy jelszó";
    }
}

// Autentikáció

function loggedIn() {
    if (isset($_SESSION['authorized']) == true) {
        return true;
    } else {
        return false;
    }
}

// loggedIn() eljárás ellenőrzése
// a loggedIn() által visszaadott értéket dolgozom fel (ez nyilván mehetne egyben is, de így áttekinthetőbb)

function loginNeeded() {
    if (loggedIn()) {
        return true;
    } else {
        header('Location: ' . DIRADMIN . 'login.php'); // ezért volt fontos a / jel az url-elnél, hogy itt szépen hozzá tudja fűzni
    }
}

// kijelentkezés-eljárás

function logout() {
    unset($_SESSION['authorized']);
    header('Location: ' . DIRADMIN . 'login.php');
    exit();
}

// sikeres és hibás üzenetek összekészítése-eljárások

function messages() {
    
    $messages = "";
    
    if (isset($_SESSION['success']) != "") {
        $messages = '<h3 align="center">' . $_SESSION['success'] . '</h3>';
        // ürítem a tömböt, hogy ne maradjon benne semmi, különben mindig lenne benne valami, és nem lenne dinamikus a kijelzés
        $_SESSION['success'] = "";
    }

    if (isset($_SESSION['error']) != "") {
        $messages = '<h3 align="center">' . $_SESSION['error'] . '</h3>';
        $_SESSION['error'] = "";
    }
    
    echo $messages;
    
}

// külön hiba-eljárás

function errors($error) {
    
    if (!empty($error)) {
        $i = 0;
        while ($i < count($error)) {
            // bejárjuk az $error-tömböt, és megnézzük, hány hiba van benne
            // hogy ne írja mindig felül az előzőt, a $displayError-hoz mindig hozzáfűzzük az üzenetet
            $displayError .= '<h3 align="center">' . $error[$i] . '</h3>';
            $i++;
        }
        echo $displayError;
    }
}
