<?php

$name = "";
$email = "";
$nameError = "";
$emailError = "";
$successMessage = "";
$passwordMessage = "";

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'login_system';

if (isset($_POST['submit'])) {
    if (!($_POST['name'] == "")) {
        $name = $_POST['name'];

        if (preg_match("/[a-zA-ZöüóőúéáűíÖÜÓŐÚÉÁŰÍ ]/", $name)) {

            if (!($_POST['email'] == "")) {
                $email = $_POST['email'];
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz%#*!_';
                    $password = substr(str_shuffle($chars), 0, 8);

                    $password1 = sha1($password);

                    $dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Connection error");
                    $dbselect = mysqli_select_db($dblink, $dbname) or die(mysqli_error($dblink));

                    $result = mysqli_query($dblink, "SELECT * FROM registration WHERE `email` = '$email'") or die(mysqli_error());

                    $data = mysqli_num_rows($result);

                    if ($data == 0) {
                        $query = mysqli_query($dblink, "INSERT INTO registration (`name`, `email`, `password`) VALUES ('$name', '$email', '$password1')") or die(mysqli_error($dblink));

                        if($query) {
                            $to = $email;
                            $subject = "Your password";

                            $message = "Hello $name!"
                                . "Az ön jelszava elkészült."
                                . "A belépéshez használható email-cím: $email"
                                . "Az ön jelszava: $password."
                                . "Most már beléphet az oldalra."
                                . "Üdvözlettel: Karcsi"
                                . "Az ön beleegyezése nélkül nem küldünk ki több emailt önnek";
                        }
                    } else {
                        $emailError = "The email address is already registered.";
                    }
                } else {
                    $emailError = "The email format is not correct.";
                }
            } else {
                $emailError = "Providing email address is mandatory.";
            }
        } else {
            $nameError = "Only letters and space characters are allowed.";
        }
    } else {
        $nameError = "Providing your name is mandatory.";
    }
}