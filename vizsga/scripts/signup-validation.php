<?php

session_start();


$error = [];
$success = [];

// ellenőrzés submit-gombra
if (filter_input(INPUT_POST, 'submit')) {

    // cellák kitöltöttségének ellenőrzése
    if (!empty(filter_input(INPUT_POST, 'username')) && !empty(filter_input(INPUT_POST, 'email')) && !empty(filter_input(INPUT_POST, 'password')) && !empty(filter_input(INPUT_POST, 'cpassword'))) {

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password'); //jelszótisztítás a titkosítás során történne
        $cpassword = filter_input(INPUT_POST, 'cpassword'); //jelszótisztítás a titkosítás során történne
        
        // email-formátum ellenőrzése
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            require 'scripts/db-connect.php';
            $result = mysqli_query($dblink, "SELECT * FROM users WHERE `user_name`='$username' OR `user_email`='$email'") or die(mysqli_error($dblink));
            
            $numberOfRows = mysqli_num_rows($result);
            
            // találatok számának ellenőrzése - ha egyenlő nullával, a regisztráció folytatódhat
            if ($numberOfRows == 0) {
                
                if ($password == $cpassword) {
                    $dbUpdate = mysqli_query($dblink, "INSERT INTO users (`user_name`, `user_email`, `password`) VALUES ('$username', '$email', '$password')") or die(mysqli_error($dblink));
                    
                    if ($dbUpdate) {
                        $success['signup'] = '<p style="color:green;">Successful registration!</p><br/>'
                                . '<a href="login.php">Click to login</a>';
                    }
                    
                } else {
                   $error['signup'] = '<p style="color:red;">Passwords don\'t match</p>'; 
                }
                
            } else {
                $error['signup'] = '<p style="color:red;">Username and/or email already exists in the database</p>';
            }  
            
        } else {
            $error['signup'] = '<p style="color:red;">Incorrect email format</p>';
        }
        
    } else {
        $error['signup'] = '<p style="color:red;">All fields are mandatory</p>';
    }
}


