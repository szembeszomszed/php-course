<?php

session_start();
if (!isset($_SESSION['name'])) {
    header("Location: session-bejelentkezik_0725.php"); //ha nem lett beállítva a name, visszairányítjuk az előző oldalra
} else {
    $name = $_SESSION['name'];
    
}

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>A <?php echo $name;?> profiloldala</title>
    </head>
    <body>
        <h1>Hello <?php echo $name;?></h1>
        <h3><a href="session-kijelentkezik_0725.php">Kijelentkezés</a></h3>
    </body>
</html>
