<?php
session_start();

$error = [];

if (filter_input(INPUT_POST, 'submit')) {

    if (!empty(filter_input(INPUT_POST, 'username')) && !empty(filter_input(INPUT_POST, "password"))) {

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password0 = filter_input(INPUT_POST ,'password');
        $password1 = sha1($password0);

        require 'db-connect.php';

        $query = mysqli_query($dblink, "SELECT * FROM users WHERE `userName` = '$username' AND `userPassword` = '$password1'") or die(mysqli_error($dblink));
        $numberOfRows = mysqli_num_rows($query);

        if ($numberOfRows == 1) {
            $_SESSION['username'] = $username;
            header('location: index.php');
            exit();

        } else {

            $error['login'] = '<p style="color: red; display: inline; margin-left: 5px;">Incorrect username and/or password</p>';
        }

    } else {

        $error['login'] = '<p style="color: red; display: inline; margin-left: 5px;">Both fields are mandatory</p>';
    }
}