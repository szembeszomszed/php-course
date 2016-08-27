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
<a href="logout.php" style="margin-left: 95%; top: 0%;">Logout</a>
</body>
</html>
