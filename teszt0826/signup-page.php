<?php
require 'scripts/signup-validation.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Signup Page</title>
</head>
<body>
<h2>Register below</h2>
<form method="post">
    <label for="username">Username</label><br/>
    <input type="text" name="username" value="<?php echo (filter_input(INPUT_POST, 'username') ? $username : "");?>"><br/><br/>
    <label for="email">Email</label><br/>
    <input type="text" name="email" value="<?php echo (filter_input(INPUT_POST, 'email') ? $email : "");?>"><br/><br/>
    <input type="radio" name="gender" value="female" id="female">
    <label for="female">Female</label>
    <input type="radio" name="gender" value="male" id="male">
    <label for="male">Male</label>
    <input type="radio" name="gender" value="nspec" id="nspec">
    <label for="nspec">Not specified</label><br/><br/>
    <label for="age">Age</label><br/>
    <input type="text" name="age" size="3"><br/><br/>
    <select name="location">
        <option value="0">---select your location---</option>
        <option value="1">Africa</option>
        <option value="2">Americas</option>
        <option value="3">Asia</option>
        <option value="4">Australia</option>
        <option value="5">Europe</option>
    </select>
    <br/><br/>

    <input type="submit" name="submit" value="Register"><?php echo (!empty($error) ? $error['signup'] : ""); ?><br/><br/>

</form>
</body>
</html>
