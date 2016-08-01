<?php include './jelszo_validacio.php'; // itt csapjuk hozzá a jelszo_validacio fájlunkat, ezért az tud dolgozni az itt beírt form-adatokkal?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP beléptető rendszer</title>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Üdvözöljük! Jelentkezzen be!</h2>
                <form action="jelszo_login.php" method="post">
                    <label class="heading">Email</label><br/>
                    <input type="text" name="email"/><br/><br/>
                    <label class="heading">Jelszó</label><br/>
                    <input type="password" name="password"/><br/><br/>
                    
                    <input type="submit" name="submit" value="Belépés"/>                    
                    <span class="error"><?php echo $Error;?></span>
                    <span class="success"><?php echo $successMessage;?></span>                   
                </form>
                <br/>
                <a href="elfelejtett_jelszo.php">Elfelejtett jelszó</a>
                <a href="regisztracio_form.php">Regisztráció</a>
            </div>
        </div>
    </body>
</html>
