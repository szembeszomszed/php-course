<?php

if (filter_input(INPUT_POST, 'submit')) {

    if (!empty(filter_input(INPUT_POST, 'username')) &&
        !empty(filter_input(INPUT_POST, 'email')) &&
        !empty(filter_input(INPUT_POST, 'gender')) &&
        !empty(filter_input(INPUT_POST, 'age')) &&
        filter_input(INPUT_POST, 'location') != "default") {

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender');
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $location = filter_input(INPUT_POST, 'location');

        require 'db-connect.php';
        $query = mysqli_query($dblink, "SELECT * FROM users WHERE `userName`='$username'") or die(mysqli_error($dblink));
        $numberOfRows = mysqli_num_rows($query);

        if ($numberOfRows == 0) {

            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email) {
                $query = mysqli_query($dblink, "SELECT * FROM users WHERE `userEmail` = '$email'") or die(mysqli_error($dblink));
                $numberOfRows = mysqli_num_rows($query);

                if ($numberOfRows == 0) {
                    /*
                    $age = preg_replace('/[^0-9]/', '', $age);
                    echo $age;
                    */

                    if (is_numeric($age)) {
                        //echo $age;
                        $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!"#$%()*+,-./:;<=>?@[\]_{|}';
                        $password0 = substr(str_shuffle($characters), 0, 8);
                        $password1 = sha1($password0);

                        $query = mysqli_query($dblink, "INSERT INTO users(`userName`, `userEmail`, `userPassword`, `userGenre`, `userAge`, `userLocation`) VALUES ('$username', '$email', '$password1', '$gender', '$age', '$location')") or die(mysqli_error($dblink));
                        echo "success! your password is: $password0";

                    } else {
                        $error['signup'] = '<p style="color: red; display: inline; margin-left: 5px;">Age must be a number.</p>';
                    }

                } else {
                    $error['signup'] = '<p style="color: red; display: inline; margin-left: 5px;">Email address already registered.</p>';
                }

            } else {
                $error['signup'] = '<p style="color: red; display: inline; margin-left: 5px;">Incorrect email format.</p>';
            }

        } else {
            $error['signup'] = '<p style="color: red; display: inline; margin-left: 5px;">Username already exists in the database.</p>';
        }

    } else {
        $error['signup'] = '<p style="color: red; display: inline; margin-left: 5px;">Please make sure to provide all required information.</p>';
    }
}