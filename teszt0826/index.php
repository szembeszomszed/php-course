<?php
session_start();

$loggedInUser = $_SESSION['username'];


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Index - <?php echo $loggedInUser;?></title>
</head>
<body>
<a href="logout.php" style="margin-left: 96%; top: 0%;">Logout</a>
<p style="margin-left: 90%; top: 0%;">logged in as <strong><?php echo $loggedInUser;?></strong></p>
</body>
</html>
