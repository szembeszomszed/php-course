<?php
session_start();
session_destroy();
/*
session_start();
if(isset($_SESSION['name'])) {
    unset($_SESSION['name']); // csak a name kulcs törlése
}
*/
$loginError = "";
if (isset($_POST['user_name'])) {
    if ($_POST['user_name'] == "admin") {
        session_start();
        $_SESSION['name'] = $_POST['user_name']; //a session name kulcsára beállítjuk a formba beírt user_name-kulcsot
        header("Location: employees-db-admin.php"); //átírányítom a megfelelő oldalra
    } else {
        $loginError = '<p style="color: red">Hibás felhasználónév</p>';
    }
}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = "";
$dbname = 'classicmodels';

$dblink = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname) or die(mysqli_error($dblink));
$dbselect = mysqli_select_db($dblink, $dbname) or die(mysqli_error($dblink));

mysqli_set_charset($dblink, 'utf-8');

$eredmeny = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees") or die(mysqli_error($dblink)); // a súgó a jelek szerint nem mindenhova tesz ``-t
$output = '<table border="1" style="border-collapse: collapse;">'
    . '<tr>'
    . '<th style="width:100px"><a href="?order=empnum&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Azonosító <a href="?order=empnum&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
    . '<th style="width:130px"><a href="?order=first&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Név <a href="?order=first&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
    . '<th style="width:80px"><a href="?order=ext&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Mellék <a href="?order=ext&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
    . '<th style="width:200px"><a href="?order=email&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Email <a href="?order=email&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
    //. '<th>Művelet</th>'
    . '</tr>';

while ($row = mysqli_fetch_assoc($eredmeny)) {
    $output .= "<tr>"
        . "<td style=\"width:100px\">{$row['employeeNumber']}</td>"
        . "<td style=\"width:130px\">{$row['firstName']} {$row['lastName']}</td>"
        . "<td style=\"width:80px\">{$row['extension']}</td>"
        . "<td style=\"width:200px\">{$row['email']}</td>"
        //. "<td><a href='?act=mod&amp;tid={$row['employeeNumber']}''>Módosít</a> | <a href='?act=del&amp;tid={$row['employeeNumber']}'>Töröl</a></td>"
        . "</tr>";
}
$output .= '</table>';

?>



<!DOCTYPE html>
<html>
    <head>
        <style>
            #login-form {
                margin: -500px 0 0 800px;
            }
            #submit {
                margin-left: 75px;
            }
        </style>

    </head>

    <body>
    <?php
    echo $output;
    ?>
        <div id="login-form">
            <form id="main_form" method="post">
                <input type="text" name="user_name" size="20" placeholder="Kérem, írja ide a nevét"/>
                <br/>
                <input type="submit" id="submit" value="Bejelentkezés"/>
            </form>
            <?php
            echo $loginError;
            ?>
        </div>


    </body>


</html>