<?php

require './scripts/login-validation.php';

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Welcome to the Login Page!</h2>
        <h4>You can sign in below</h4>
        <br/><br/>
        <div id="loginform">
            <form method="post" action="login.php">
                <label for="username">Username</label>
                <br/>
                <input type="text" name="username">
                <br/><br/>
                <label for="password">Password</label>
                <br/>
                <input type="password" name="password">
                <br/><br/>
                <input type="submit" name="submit" value="Sign in">
                <br/>
                <?php echo (!empty($error) ? $error['login'] : "");?>
                <br/><br/>
            </form>
            <a href="./signup.php">New user? Click to sign up!</a>
        </div>
    </body>
</html>
