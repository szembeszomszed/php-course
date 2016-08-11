<?php

session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    if ($username == 'admin') {
        echo "<h5>Logged in as $username</h5>";
        $output = "";
    } else {
        echo "<h3>Hi $username! You don't yet have the rights to modify the database. Please contact the system administrator.</h3>";
        exit();
    }
} else {
    header('Location: ./login.php');
    exit();
}
