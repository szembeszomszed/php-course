<?php

include './session.php';

$error = "";
$successMessage = "";

if (isset($_POST['submit'])) {

    if (!($_POST['newpassword'] == "" && $_POST['cnewpassword'] == "")) {

        $newpassword = $_POST['newpassword'];
        $cnewpassword = $_POST['cnewpassword'];

        if ($newpassword == $cnewpassword) {

            $password = sha1($cnewpassword);

            $connection = mysqli_connect('localhost', 'root', '', 'login_system');

            // a $login_password a session.php-ból jön: $login_password = $row['password']; (ez pedig az adatbázisból érkezik)
            $query = mysqli_query($connection, "UPDATE registration SET `password` = '$password' WHERE `password` = '$login_password'") or die(mysqli_error($connection));

            if ($query) {
                $successMessage = "Password has been changed succesfully.";
            }
        } else {
            $error = "The passwords do not match.";
        }
    } else {
        $error = "Please fill in each field.";
    }

}