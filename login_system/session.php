<?php

// build connection
$connection = mysqli_connect("localhost", "root", "", "login_system") or die('Connection error');

// db selection
//$db = mysqli_select_db($connection, "login_system");

// session
session_start();

$email_check = $_SESSION['login_user'];
$ses_sql = mysqli_query($connection, "SELECT * FROM registration WHERE `email` = '$email_check'") or die(mysqli_error());
$row = mysqli_fetch_assoc($ses_sql);

$login_session = $row['name'];
$login_password = $row['password'];

// if no login_session set:
if (!isset($login_session)) {
    mysqli_close($connection);
    header("location: login_page.php");
}