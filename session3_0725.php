<?php

//Munkamenet indítása

session_start();

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Munkamenet és értékek elpusztítása</title>
    </head>
    <body>
        <?php
        // A session értékeinek teljes törlése
        session_unset();
        echo 'A session értékei törölve <br/>';
        
        // A session elpusztítása
        session_destroy();
        echo 'A session elpusztítva <br/>';
        ?>
    </body>
</html>
