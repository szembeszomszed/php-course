<?php


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'classicmodels';

$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
        or die('<h2>Nincs kapcsolat, hívd a rendszergazdát, vagy kezdj el imádkozni</h2>');
$dbselect = mysqli_select_db($dblink, $dbname) or die(mysqli_error());

mysqli_set_charset($dblink, 'utf-8');

if (filter_input(INPUT_GET, 'act')) {
    $action = filter_input(INPUT_GET, 'act');
} else {
    $action = 'list';
}

if(filter_input(INPUT_GET, 'tid', FILTER_VALIDATE_INT)) {
    $tid = filter_input(INPUT_GET, 'tid', FILTER_VALIDATE_INT);
} else {
    $tid = NULL;
}


switch ($action) {
    case 'del':
        $output = '<a href="?act=list">Vissza</a> | ';
        $output .= ( $tid ? "Törlünk: ".$tid : 'nincs értelmes id');
        break;
    case 'mod':
        $output = '<a href="?act=list">Vissza</a> | <h2>Módosítunk</h2>';
        break;
    case 'new':
        echo '<a href="?act=list">Vissza</a> | <h2>Új felvitel</h2>';
    default:
        /*************Listázás**************/
        $eredmeny = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees") or die(mysqli_error($dblink)); // a súgó a jelek szerint nem mindenhova tesz ``-t
        $output = '<a href="?act=new">Új felvitel</a>'
                . '<table border="1" style="border-collapse: collapse;">'
                . '<tr>'
                . '<th>Azonosító</th>'
                . '<th>Név</th>'
                . '<th>Mellék</th>'
                . '<th>Email</th>'
                . '<th>Művelet</th>'
                . '</tr>';

        while ($row = mysqli_fetch_assoc($eredmeny)) {
            $output .= "<tr>"
                    . "<td>{$row['employeeNumber']}</td>"
                    . "<td>{$row['firstName']} {$row['firstName']}</td>"
                    . "<td>{$row['extension']}</td>"
                    . "<td>{$row['email']}</td>"
                    . "<td><a href='?act=mod'>Módosít</a> | <a href='?act=del&amp;tid={$row['employeeNumber']}'>Töröl</a></td>"
                    . "</tr>";
        }
        $output .= '</table>';
        break;
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>almalmazottak PHP megjelenítése</title>
    </head>
    <body>
        <?php
        echo $output;
        ?>
    </body>
</html>
