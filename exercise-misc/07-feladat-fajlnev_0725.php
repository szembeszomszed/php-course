<!DOCTYPE html>
<!--
7) Írjunk egy PHP szkriptet ami visszaadja a jelenlegi fájlnevet
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Jelenlegi fájl neve</h2>
        <?php
        
        $jelenlegiFajlNeve = basename($_SERVER['PHP_SELF']); // a basename miatt csak a fájl nevét írja ki
        //különben az útvonalat is
        echo $jelenlegiFajlNeve;
        
        // ha az ügyfél saját serverén akarja tároltatni a fájlokat, 
        // hajlamos belenyúlkálni, és elrontani dolgokat
        // ezért hasznos levédeni a dolgot
        // például kis script-könyvtárat létrehozni, ami tárolja a fájlok tartalmát, útvonalát
        // lelőni az oldalt hiba esetén - csak általunk ismert hibakóddal
        
        
        ?>
    </body>
</html>
