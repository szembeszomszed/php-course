<?php
require 'scripts/login-validation.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
</head>
<body>
<h2>Welcome to the Login Page</h2>
<form method="post">
    <label for="username">Username</label><br/>
    <input type="text" name="username" value="<?php echo (filter_input(INPUT_POST, 'username') ? $username : "");?>"><br/><br/>
    <label for="password">Password</label><br/>
    <input type="password" name="password"><br/><br/>
    <input type="submit" name="submit" value="Sign in"><?php echo (!empty($error) ? $error['login'] : ""); ?><br/><br/>
    <a href="forgotten-password.php">Forgotten password</a><br/><br/>
    <a href="signup-page.php"><strong>New user?</strong> Click to sign up</a>
</form>
</body>
</html>
