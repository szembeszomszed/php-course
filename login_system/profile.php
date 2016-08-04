<?php
include './profile_validation.php';

?>


<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
</head>
<body>
<div class="container">
    <div class="main">
        <h2>Welcome <i><?php echo $login_session; ?></i></h2>
        <hr/>
        <form action="profile.php" method="post"><!-- a form action itt is magát hívja meg -->
            <a class="logout" href="kilep.php">Kilépés</a>

            <h3>Change your password!</h3>
            <label>New password</label><br/>
            <input type="password" name="newpassword"/><br/><br/>

            <label>Confirm new password</label><br/>
            <input type="password" name="cnewpassword"/><br/><br/>

            <input type="submit" name="submit" value="Change"/>
            <span class="error"><?php echo $error; ?></span>
            <span class="success"><?php echo $successMessage; ?></span>

        </form>
    </div>
</div>
</body>
</html>