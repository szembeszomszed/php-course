<?php

session_start();


$error = [];

// ellenőrzés submit-gombra
if (filter_input(INPUT_POST, 'submit')) {
    
    // cellák kitöltöttségének ellenőrzése
    if (!empty(filter_input(INPUT_POST, 'username')) && !empty(filter_input(INPUT_POST, 'password'))) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password'); // jelszótisztítás majd a titkosítás során lenne
        
        require 'scripts/db-connect.php';
        $result = mysqli_query($dblink, "SELECT * FROM users WHERE `user_name`='$username' AND `password`='$password'") or die(mysqli_error($dblink));
        
        $numberOfRows = mysqli_num_rows($result);
        
        // találatok számának ellenőrzése - ha az eredmény 1, a belépés sikeres
        if ($numberOfRows == 1) {
            $_SESSION['user'] = $username;
            header ('Location: ./profile.php');
            exit();
        } else {
            $error['login'] = '<p style="color:red;">Incorrect username and/or password</p>';
        }
    } else {
        $error['login'] = '<p style="color:red;">Username and password are mandatory fields</p>';
    }
}

