<?php
var_dump($_GET); // a _GET egy szuperglobális beépített tömb
// ŰRLAP FELDOLGOZÁSA

//akkor kezdjük el az űrlap feldolgozását, ha van mit feldolgozni, azaz van 
//submit kulcsunk, mert így neveztük el az űrlapot
//általában praktikus a submit-ra ellenőrizni

//oldschool megoldás

/*
if(isset($_GET['submit'])) { // a _GET tömb submit kulcsára keresünk
    echo '<h3>Feldolgozás</h3>';
}
*/

//új megoldás - szuperglobális (beépített) tömbök szűrése

/*
$teszt = filter_input(INPUT_GET, 'submit');
// a változóba, ha nincs érték, NULL kerül
// ha van submit kulcs, akkor az értéke kerül a változóba

*/

// a használt szuperglobális tömb típusa attól függ, hogy mit állítunk be a html form methodjaként
// ŰRLAP ESETÉN SUBMITRA ÉRDEMES VIZSGÁLNI, NEM PEDIG MEZŐRE

if(filter_input(INPUT_GET, 'submit')) { // így nézzük meg, hogy történt-e egyáltalán gombnyomás
    $a = filter_input(INPUT_GET, 'a'); // a form a-változójába kerülő értéket egy most deklarált $a változóba mentjük el
    // ha volt a mezőben érték, akkor írjuk ki, hogy feldolgozás, de ha üresen maradt, akkor kiírjuk, hogy kötelező kitölteni
    if($a == '') {
        echo '<h4>Az (a) mezőt kötelező kitölteni!</h4>';
    } else {
        echo '<h2>Feldolgozás</h2>';
    }
}

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Űrlap PHP-ban</title>
    </head>
    <body>
        <h1>Pozitív szám űrlap</h1>
        <form method="get"> <!-- nem adunk meg actiont, így magának küldi az adatot-->
            <fieldset> 
                <legend>Pozitív szám</legend>
                <label for="a">Adjon meg egy pozitív egész számot 1 és 100 között</label>
                <input type="text" name="a" placeholder="123"/>
            </fieldset>
            <input type="submit" name="submit" value="Csűrjük"/>
        </form>
    </body>
</html>
