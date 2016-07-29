<?php

//megnézzük, hogy be van-e állítva a POST tömb user_name kulcsa - ha igen, indítjuk a sessiont 
if (isset($_POST['user_name'])) {
    session_start();
    $_SESSION['name'] = $_POST['user_name']; //a session name kulcsára beállítjuk a formba beírt user_name-kulcsot
    header("Location: sessionprofil_0725.php"); //átírányítom a megfelelő oldalra
    
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Session-kezelés PHP-ban</title>
    </head>
    <body>
        <h2>Session-kezelés PHP-ban</h2>
        <h4>A következő módon használjuk: </h4>
        <ul>
            <li>Űrlapon beírjuk a nevet</li>
            <li>Betöltjük a másik profiloldalt a névvel</li>
            <li>Kijelentkezés, session elpusztítása</li>
        </ul>
        <form id="main_form" method="post">
            <input type="text" name="user_name" size="40" placeholder="Kérem, írja ide a nevét"/>
            <input type="submit" value="Bejelentkezés"/>
        </form>
    </body>
</html>
