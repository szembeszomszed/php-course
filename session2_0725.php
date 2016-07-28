<?php

//Munkamenet indítása

session_start();


?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Munkamenet kiolvasása</title>
    </head>
    <body>
        <?php
        // Írassuk ki a session kulcsait
        echo 'A kedvenc színem a '.$_SESSION['kedvencszin'].'<br/>';
        echo 'A kedvenc állatom a '.$_SESSION['kedvencallat'].'<br/>';
        ?>
    </body>
</html>
