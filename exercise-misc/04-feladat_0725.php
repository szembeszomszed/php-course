<!DOCTYPE html>

<!--4) Írjunk egy HTML formot egy darab text mezővel, ami gombnyomásra kiirja a text mező tartalmát (a mező alá)-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post">
            <input type="text" name="nev" placeholder="Névbeírás"/>
            <input type="submit" name="submit" value="Névbeküldés"/>
        </form>

        <?php
        if (!empty($_POST['nev'])) {
            $nev = $_POST['nev'];
            echo "<h3> Az ön neve: $nev</h3>";
        }
        ?>
    </body>
</html>
