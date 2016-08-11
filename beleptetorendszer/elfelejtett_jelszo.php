<?php include './elfelejtett_jelszo_generator.php';?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP beléptető rendszer</title>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Itt tud új jelszót kérni magának</h2>
                <form action="elfelejtett_jelszo.php" method="post">
                    <label class="heading">Email</label><br/>
                    <input type="text" name="email"/><br/><br/>
                    
                    <input type="submit" name="submit" value="Jelszó újraküldése"/>                    
                    <span class="error"><?php echo $Error;?></span>
                    <span class="success"><?php echo $successMessage.' - '.$password;?></span> 
                    <!--éles szerveren a $password változót törölni kell - itt csak azért van, mert valójában nem küldünk emailt-->
                </form>
                <br/>
                <p><b>Figyelem!</b> A jelszavát a regisztrációkor megadott email-címére küldjük el!</p>
                <a href="jelszo_login.php">Belépés</a>
                
            </div>
        </div>
    </body>
</html>
