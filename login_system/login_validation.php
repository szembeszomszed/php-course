<?php
session_start();

$error = "";
$successMessage = "";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'login_system';

if (isset($_POST['submit'])) {
    if (!($_POST['email'] == "" && $_POST['password'] == "")) {
        $email = $_POST['email'];
        $password = sha1($_POST['password']);

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Connection error.");
            $dbselect = mysqli_select_db($dblink, $dbname) or die(mysqli_error($dblink));
            mysqli_set_charset($dblink, 'utf-8');

            $result = mysqli_query($dblink, "SELECT * FROM registration WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_error($dblink));

            $data = mysqli_num_rows($result);

            if ($data == 1) {
                $_SESSION['login_user'] = $email;
                header('location: profile.php');

            } else {
                $error = "Email and password don't match.";
            }

            mysqli_close($dblink);

        } else {
            $error = "Email format is incorrect.";
        }

    } else {
        $error = "Please fill in each field.";
    }
}