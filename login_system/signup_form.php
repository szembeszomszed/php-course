<?php
include './password_generator.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <h2>Sign up</h2>
                <form action="signup_form.php" method="post">
                    <label>Name</label><br/>
                    <input type="text" name="name" value="<?php echo filter_input(INPUT_POST, 'name');?>"/>
                    <span><?php echo $nameError; ?></span><br/><br/>

<label>Email</label><br/>
<input type="text" name="email" value="<?php echo filter_input(INPUT_POST, 'email');?>"/>
<span><?php echo $emailError; ?></span><br/><br/>

<input type="submit" name="submit" value="Sign up"/>
<span><?php echo $successMessage." ".$password; ?></span>
<!-- a hozzáfűzött $password változót törölni kell élesben!! - most azért van ez itt, mert a xampp nem tud emailt küldeni, amíg nem konfiguráljuk - márpedig most nem fogjuk -->
<span><?php echo $passwordMessage; ?></span>
</form>
<p>Your password will be sent to your email address.</p>
<a href="login_page.php">Login</a>
</div>
</div>

</body>
</html>