<?php
session_start();
session_destroy();
var_dump($_SESSION);

?>

<!doctype html>
<html>

<h4>You've logged out successfully</h4>
<a href="login-page.php">Click to login again</a>
</html>




