<?php

session_start();
if (!isset($_SESSION['name'])) {
    header("Location: employees-db.php"); //ha nem lett beállítva a name, visszairányítjuk az előző oldalra
} else {
    $name = $_SESSION['name'];
}

//házi feladat:
//1) az új felvitelre jelenjen meg egy form, ahol felvihetünk adatokat az employeesba
//2) a módosítás linkre kattintva lehessen módosítani a már feltöltött értékeken, mindezt úgy, hogy egy űrlapba betölti a jelenlegi értékeket, majd gombnyomásra változik
//3a) a törlés feliratra töröljük az adott tételt az adatbázisból
//3b) kérdezzen rá, hogy akarok-e törölni
// tipp: törölsz-e paraméter berakható, aztán erre rákereshetünk, hogy benne-e van-e a GET tömbben
// tehát linkbe plusz paraméter, hogy akar-e törölni, és a GET-ben ezt lekezelni
//4a) tegyünk fel egy rendez gombot, amivel tetszőleges mezőt rendezünk sorba, mégpedig növekvő vagy csökkenőbe
//4b) tegyünk be minden fejlécbe egy gombot vagy linket, ami rendez (növekvő vagy csökkenőbe)
//5) a products táblával végezzük el az ugyanezeket a műveleteket, és pontokat is
//6) ha mindez megvan, akkor a 0725 napi session project alapján készítsünk egy adminfelületet (csak névre léphetünk be a felületre - a név legyen 'admin', és a felviteleket és a módosítást csak ott lehet elvégezni - maga a tábla megjelenhet amúgy is, de kell mellé egy beléptető, ami csak az admint engedi munkálkodni
//7) sör

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

if(filter_input(INPUT_GET, 'order')) {
    $orderBy = filter_input(INPUT_GET, 'order');
} else {
    $orderBy = NULL;
    //var_dump($orderBy);
}

if(filter_input(INPUT_GET, 'dir')) {
    $direction = filter_input(INPUT_GET, 'dir');
} else {
    $direction = NULL;
    //var_dump($direction);
}

switch ($action) {
    case 'del':
        if (filter_input(INPUT_GET, 'confirm')) {
            $confirm = filter_input(INPUT_GET, 'confirm');
        } else {
            $confirm = 'list';
        }

        $dataToDelete = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees WHERE `employeeNumber` = '$tid'") or die(mysqli_error($dblink));
        $row = mysqli_fetch_assoc($dataToDelete) or die(mysqli_error($dblink));
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $extension = $row['extension'];
        $email = $row['email'];
        $output = '<a href="?act=list">Vissza</a>';
        //$output .= ( $tid ? "Törlünk: ".$tid : 'nincs értelmezhető azonosító');
        if ($tid) {
            $output .= ' <br/><br/> A következő adatok törölve lesznek: <br/><br/>'
                . '<table border="1" style="border-collapse: collapse; text-align: center;">'
                . '<tr>'
                . '<th style="width:30px">Azonosító</th>'
                . '<th style="width:130px">Név</th>'
                . '<th style="width:80px">Mellék</th>'
                . '<th style="width:200px">Email</th>'
                . '</tr>'
                . '<tr>'
                . '<td style="width:30px">'.$tid.'</td>'
                . '<td style="width:130px">'.$firstName.' '.$lastName.'</td>'
                . '<td style="width:80px">'.$extension.'</td>'
                . '<td style="width:200px">'.$email.'</td>'
                . '</tr>'
                . '</table>'
                . "<br/><br/><strong><a href='?act=del&amp;tid={$row['employeeNumber']}&amp;confirm=delete' style='color: red;'>Törlés megerősítése</a></strong>";

        }

        if ($confirm == "delete") {
            mysqli_query($dblink, "DELETE FROM employees WHERE `employeeNumber` = '$tid'") or die(mysqli_error($dblink));
            $output = '<a href="?act=list">Vissza</a> <br/><br/> <p style="color: red;">Az adatok sikeresen törölve.</p>';
        }
        break;
    case 'mod':
        echo ( $tid ? "Módosítás ".$tid : 'nincs értelmezhető azonosító');
        $dataToModify = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees WHERE `employeeNumber` = '$tid'") or die(mysqli_error($dblink));
        $row = mysqli_fetch_assoc($dataToModify) or die(mysqli_error($dblink));
        //var_dump($row);
        $azonosito = $row['employeeNumber'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $extension = $row['extension'];
        $email = $row['email'];

        $output = '<a href="?act=list">Vissza</a> | <h2>Adat módosítása</h2>';
        $output .=
            '<form method="post">
            <label for="azonosito">Azonosító</label>
            <br/>
            <input type="text" name="azonosito" placeholder="1234" value="'.$tid.'" size="30">
            <br/><br/>
            <label for="keresztnev">Keresztnév</label>
            <br/>
            <input type="text" name="keresztnev" placeholder="Károly" value="'.$firstName.'" size="30">
            <br/><br/>
            <label for="vezeteknev">Vezetéknév</label>
            <br/>
            <input type="text" name="vezeteknev" placeholder="Minta" value="'.$lastName.'" size="30">
            <br/><br/>
            <label for="mellek">Mellék</label>
            <br/>
            <input type="text" name="mellek" placeholder="x5678" value="'.$extension.'" size="30">
            <br/><br/>
            <label for="email">Email</label>
            <br/>
            <input type="text" name="email" placeholder="kminta@classicmodelcars.com" value="'.$email.'" size="30">
            <br/><br/>
            <input type="submit" name="submit" value="Módosít">

            </form>';
        if (filter_input(INPUT_POST, 'submit')) {

            function extensionCheck ($extension) {
                if (strlen($extension) != 0 && $extension[0] == 'x') {
                    return $extension;
                }
                return false;
            }

            $customFilter = [
                'keresztnev' => [
                    'filter' => FILTER_CALLBACK,
                    'options' => 'ucwords',
                ],
                'vezeteknev' => [
                    'filter' => FILTER_CALLBACK,
                    'options' => 'ucwords',
                ],
                'mellek' => [
                    'filter' => FILTER_CALLBACK,
                    'options' => 'extensionCheck',
                ],
                'azonosito' => FILTER_VALIDATE_INT,
                'email' => FILTER_VALIDATE_EMAIL,
            ];

            $hiba = [];
            $modifiedData = filter_input_array(INPUT_POST, $customFilter, $add_empty = false);

            mysqli_query($dblink, "UPDATE employees SET `employeeNumber`='$modifiedData[azonosito]',`firstName`='$modifiedData[keresztnev]', `lastName`='$modifiedData[vezeteknev]', `extension`='$modifiedData[mellek]', `email`='$modifiedData[email]' WHERE `employeeNumber` = '$tid'") or die(mysqli_error($dblink));

            echo '<p style="color: red;">Az adatok sikeresen módosítva lettek.</p>';
        }
        break;
    case 'new':
        $hiba = [];
        if (filter_input(INPUT_POST, 'submit')) {
            $hiba = [];
            function extensionCheck($extension)
            {
                if (strlen($extension) != 0 && $extension[0] == 'x') {
                    return $extension;
                }
                return false;
            }

            $customFilter = [
                'keresztnev' => [
                    'filter' => FILTER_CALLBACK,
                    'options' => 'ucwords',
                ],
                'vezeteknev' => [
                    'filter' => FILTER_CALLBACK,
                    'options' => 'ucwords',
                ],
                'mellek' => [
                    'filter' => FILTER_CALLBACK,
                    'options' => 'extensionCheck',
                ],
                'azonosito' => FILTER_VALIDATE_INT,
                'email' => FILTER_VALIDATE_EMAIL,
            ];

            // végül ez nem lett használva, mert egyszerűbb megoldás is akadt
            //$tablaAdat = filter_var_array($beirtAdat, $customFilter);
            $data = filter_input_array(INPUT_POST, $customFilter, $add_empty = false);
            if ($data['azonosito'] != "") { // beírt azonosító keresése az adatbázisban
                $empNumCheck = mysqli_query($dblink, "SELECT * FROM employees WHERE `employeeNumber` = '$data[azonosito]'") or die(mysqli_error($dblink));
                $numberOfRows = mysqli_num_rows($empNumCheck); // a beírt azonosítóval bíró sorok száma az adatbázisban
                if ($numberOfRows > 0) {
                    $hiba['azonosito'] = '<p style="color: red; display: inline;">A beírt azonosító már létezik az adatbázisban.</p>';
                    //var_dump($hiba);
                }
            }

            if (!$data['email']) {
                $hiba['email'] = '<p style="color: red; display: inline;">Hibás email-formátum</p>';
            }

            if ($data['email'] != "") {
                $empNumCheck = mysqli_query($dblink, "SELECT * FROM employees WHERE `email` = '$data[email]'") or die(mysqli_error($dblink));
                $numberOfRows = mysqli_num_rows($empNumCheck);
                if ($numberOfRows > 0) {
                    $hiba['email'] = '<p style="color: red; display: inline;">A beírt email-cím már létezik az adatbázisban.</p>';
                    //var_dump($hiba);
                }
            }

            if (empty($hiba)) {
                mysqli_query($dblink, "INSERT INTO employees(`employeeNumber`, `firstName`, `lastName`, `extension`, `email`) VALUES ('$data[azonosito]', '$data[keresztnev]', '$data[vezeteknev]', '$data[mellek]', '$data[email]')") or die(mysqli_error($dblink));
                echo '<p style="color: red;">Az adatok sikeresen hozzáadva</p>';
            }
        }

        echo '<a href="?act=list">Vissza</a>';
        echo
        '<form method="post">
            <label for="azonosito">Azonosító</label>
            <br/>
            <input type="text" name="azonosito" placeholder="1234" size="30">' . ((empty($hiba["azonosito"]) ? "" : $hiba["azonosito"])) . '
            <br/><br/>
            <label for="keresztnev">Keresztnév</label>
            <br/>
            <input type="text" name="keresztnev" placeholder="Károly" size="30">
            <br/><br/>
            <label for="vezeteknev">Vezetéknév</label>
            <br/>
            <input type="text" name="vezeteknev" placeholder="Minta" size="30">
            <br/><br/>
            <label for="mellek">Mellék</label>
            <br/>
            <input type="text" name="mellek" placeholder="x5678" size="30">
            <br/><br/>
            <label for="email">Email</label>
            <br/>
            <input type="text" name="email" placeholder="kminta@classicmodelcars.com" size="30">' . ((empty($hiba["email"]) ? "" : $hiba["email"])) . '
            <br/><br/>
            <input type="submit" name="submit" value="Rögzít">

        </form>';

    // INNEN SZÁNDÉKOSAN HIÁNYZIK A BREAK??

    default:
        /*************Listázás**************/
        if ($orderBy == 'empnum') {

            if ($direction == "asc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `employeeNumber` ASC") or die(mysqli_error($dblink));
            } elseif ($direction == "desc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `employeeNumber` DESC") or die(mysqli_error($dblink));
            } else {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `employeeNumber` ASC") or die(mysqli_error($dblink));
            }
        } elseif ($orderBy == 'first') {
            if ($direction == "asc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `firstName` ASC") or die(mysqli_error($dblink));
            } elseif ($direction == "desc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `firstName` DESC") or die(mysqli_error($dblink));
            } else {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `firstName` ASC") or die(mysqli_error($dblink));
            }
        } elseif ($orderBy == 'ext') {
            if ($direction == "asc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `extension` ASC") or die(mysqli_error($dblink));
            } elseif ($direction == "desc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `extension` DESC") or die(mysqli_error($dblink));
            } else {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `extension` ASC") or die(mysqli_error($dblink));
            }
        } elseif ($orderBy == 'email') {
            if ($direction == "asc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `email` ASC") or die(mysqli_error($dblink));
            } elseif ($direction == "desc") {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `email` DESC") or die(mysqli_error($dblink));
            } else {
                $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `email` ASC") or die(mysqli_error($dblink));
            }
        } else {
            $dataToOrder = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees ORDER BY `employeeNumber` ASC") or die(mysqli_error($dblink));
        }
            $output = '<a href="?act=new">Új felvitel</a><br/><br/>'
                . '<table border="1" style="border-collapse: collapse;">'
                . '<tr>'
                . '<th style="width:100px"><a href="?order=empnum&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Azonosító <a href="?order=empnum&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th style="width:130px"><a href="?order=first&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Név <a href="?order=first&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th style="width:80px"><a href="?order=ext&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Mellék <a href="?order=ext&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th style="width:200px"><a href="?order=email&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Email <a href="?order=email&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th>Művelet</th>'
                . '</tr>';

            while ($row = mysqli_fetch_assoc($dataToOrder)) {
                $output .= "<tr>"
                    . "<td style=\"width:100px\">{$row['employeeNumber']}</td>"
                    . "<td style=\"width:130px\">{$row['firstName']} {$row['lastName']}</td>"
                    . "<td style=\"width:80px\">{$row['extension']}</td>"
                    . "<td style=\"width:200px\">{$row['email']}</td>"
                    . "<td><a href='?act=mod&amp;tid={$row['employeeNumber']}''>Módosít</a> | <a href='?act=del&amp;tid={$row['employeeNumber']}'>Töröl</a></td>"
                    . "</tr>";
            }

            $output .= '</table>';
/*
        } else {
            $eredmeny = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees") or die(mysqli_error($dblink)); // a súgó a jelek szerint nem mindenhova tesz ``-t
            $output = '<a href="?act=new">Új felvitel</a><br/><br/>'
                . '<table border="1" style="border-collapse: collapse;">'
                . '<tr>'
                . '<th style="width:100px"><a href="?order=empnum&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Azonosító <a href="?order=empnum&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th style="width:130px"><a href="?order=first&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Név <a href="?order=first&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th style="width:80px"><a href="?order=ext&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Mellék <a href="?order=ext&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th style="width:200px"><a href="?order=email&amp;dir=asc"><i class="fa fa-angle-double-up"></i></a> Email <a href="?order=email&amp;dir=desc"><i class="fa fa-angle-double-down"></i></a></th>'
                . '<th>Művelet</th>'
                . '</tr>';

            while ($row = mysqli_fetch_assoc($eredmeny)) {
                $output .= "<tr>"
                    . "<td style=\"width:100px\">{$row['employeeNumber']}</td>"
                    . "<td style=\"width:130px\">{$row['firstName']} {$row['lastName']}</td>"
                    . "<td style=\"width:80px\">{$row['extension']}</td>"
                    . "<td style=\"width:200px\">{$row['email']}</td>"
                    . "<td><a href='?act=mod&amp;tid={$row['employeeNumber']}''>Módosít</a> | <a href='?act=del&amp;tid={$row['employeeNumber']}'>Töröl</a></td>"
                    . "</tr>";
            }
            $output .= '</table>';
        } */
        break;
}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>alkalmazottak PHP megjelenítése</title>

    <!-- Icons -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<p style="margin-left: 1100px;"><a href="employees-db.php">Kijelentkezés</a></p>

<!--
    <div class="form">
        <form method="get">
            <strong><p>Rendezés alapja</p></strong>
            <label for="rendezes">Azonosító</label>
            <input type="radio" name="rendezes" value="azonosito">
            <label for="rendezes">Keresztnév</label>
            <input type="radio" name="rendezes" value="keresztnev">
            <label for="rendezes">Vezetéknév</label>
            <input type="radio" name="rendezes" value="vezeteknev">
            <label for="rendezes">Mellék</label>
            <input type="radio" name="rendezes" value="mellek">
            <label for="rendezes">Email</label>
            <input type="radio" name="rendezes" value="email">
            <br/>
            <strong><p>Rendezés iránya</p></strong>
            <select name="irany">
                <option value="0">----Válassz irányt----</option>
                <option value="1">Növekvő</option>
                <option value="2">Csökkenő</option>
            </select>
            <br/>
            <input type="submit" name="submit" value="Rendez">
        </form>
    </div>
    -->
<?php
echo $output;
?>
</body>
</html>
