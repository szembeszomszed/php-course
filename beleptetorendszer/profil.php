<?php include './profil_validacio.php'; // include-oljuk a validáló fájlunkat ?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP profiloldal</title>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Üdvözlöm <i><?php echo $login_session; ?></i></h2><hr/>
                <form action="profil.php" method="post"><!-- a form action itt is magát hívja meg -->
                    <a class="kijelentkezik" href="kilep.php">Kilépés</a>
                    <h3>Változtassa meg a jelszavát!</h3>
                    <label>Új jelszó</label><br/>
                    <input type="password" name="newpassword"/><br/><br/>
                    
                    <label>Jelszó még egyszer</label><br/>
                    <input type="password" name="cnewpassword"/><br/><br/>
                    
                    <input type="submit" name="submit" value="Változtat"/>                    
                    <span class="error"><?php echo $Error;?></span>
                    <span class="success"><?php echo $successMessage;?></span> 
                    
                </form>
            </div>
        </div>
    </body>
</html>
