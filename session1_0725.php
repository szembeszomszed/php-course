<?php

//Munkamenet indítása

session_start();

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Munkamenet bemutatása</title>
    </head>
    <body>
        <?php
        
        //Session változók beállítása a _SESSION szuperglobális tömbben
        
        $_SESSION['kedvencszin'] = "Piros";
        $_SESSION['kedvencallat'] = "Cica";
        echo 'A session változók beállítva';
        ?>
    </body>
</html>
