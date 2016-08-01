<?php

// ezt a fájlt fogjuk folyamatosan meghívni majd

// kapcsolat felépítése
$connection = mysql_connect("localhost", "root", "") or die(mysql_error());


// adatbázis kiválasztása
$db = mysql_select_db("loginrendszer", $connection) or die(mysql_error());


// munkamenet indítása
session_start();


// a munkamenetből változóba eltároljuk az email-címet
$email_check = $_SESSION['login_user'];


// a letárolt email-címet megkeressük az adatbázisban
$ses_sql = mysql_query("SELECT * FROM registration WHERE email='$email_check'", $connection) or die(mysql_error());


// a lekérdezett adatot asszociatív tömbbe rakom
$row = mysql_fetch_assoc($ses_sql);


// változókba kipakolom a tömb értékeit
$login_session = $row['name'];
$login_password = $row['password'];


// ha a $login_session változóm nem lett beállítva, akkor zárom a csatlakozást
if (!isset($login_session)) {
    // csatlakozás lezárása
    mysql_close($connection);
    
    // átirányítjuk a főoldalra, ahol bejelentkezhet
    header("location: jelszo_login.php");
}


