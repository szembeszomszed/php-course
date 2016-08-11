<?php

require './scripts/signup-validation.php';

?>


<!DOCTYPE html>



<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Glad to see you here!</h2>
        <h4>You can <strong>sign up</strong> below</h4>
        <br/><br/>
        <div id="loginform">
            <form method="post" action="signup.php">
                <label for="username">Username</label>
                <br/>
                <input type="text" name="username">
                <br/><br/>
                <label for="email">Email</label>
                <br/>
                <input type="text" name="email">
                <br/><br/>
                <label for="password">Password</label>
                <br/>
                <input type="password" name="password">
                <br/><br/>
                <label for="cpassword">Confirm password</label>
                <br/>
                <input type="password" name="cpassword">
                <br/><br/>
                <input type="submit" name="submit" value="Sign up">
                <br/>
                <?php echo (!empty($error) ? $error['signup'] : ""); ?>
                <?php echo (!empty($success) ? $success['signup'] : ""); ?>
                <br/><br/>
            </form>
        </div>
    </body>
</html>
