<?php include '/jelszo_generator.php'; ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP regisztráció</title>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Jelszó Regisztrációs Űrlap</h2>
                <form action="regisztracio_form.php" method="post">
                    <label>Név</label><br/>
                    <input type="text" name="name" value="<?php echo filter_input(INPUT_POST, 'name');?>"/>
                    <span><?php echo $nameError; ?></span><br/><br/>
                    
                    <label>Email</label><br/>
                    <input type="text" name="email" value="<?php echo filter_input(INPUT_POST, 'email');?>"/>
                    <span><?php echo $emailError; ?></span><br/><br/>
                    
                    <input type="submit" name="submit" value="Regisztráció"/>
                    <span><?php echo $successMessage." ".$password; ?></span>
                    <!-- a hozzáfűzött $password változót törölni kell élesben!! - most azért van ez itt, mert a xampp nem tud emailt küldeni, amíg nem konfiguráljuk - márpedig most nem fogjuk -->
                    <span><?php echo $passwordMessage; ?></span>
                </form>
                <p><b>Figyelem! </b>A jelszavát elküldjük az email-címére!</p>
                <a href="jelszo_login.php">Bejelentkezés</a>
            </div>
        </div>

    </body>
</html>
