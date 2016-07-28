<?php
session_start();

if(isset($_SESSION['name'])) {
    unset($_SESSION['name']); // csak a name kulcs törlése
    echo '<h3>Sikeresen kijelentkezett!</h3>';
}

?>