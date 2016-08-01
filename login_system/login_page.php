<?php
include './login_validation.php';
?>


<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
<div class="container">
    <div class="main">
        <h2>Welcome to the Page!</h2>
        <form action="login_page.php" method="post">
            <label class="heading">Email</label><br/>
            <input type="text" name="email"/><br/><br/>
            <label class="heading">Password</label><br/>
            <input type="password" name="password"/><br/><br/>

            <input type="submit" name="submit" value="Login"/>
            <span class="error"><?php echo $error;?></span>
            <span class="success"><?php echo $successMessage;?></span>
        </form>
        <br/>
        <a href="forgotten_password.php">I don't remember my password</a>
        <br/>
        <a href="signup_form.php">Sign up</a>
    </div>
</div>
</body>
</html>
