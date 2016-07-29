<?php

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
            $output = '<a href="?act=list">Vissza</a> <br/><br/> <p style="color: red;">Az adat sikeresen törölve.</p>';
        }
        break;
    case 'mod':
        echo ( $tid ? "Módosítás ".$tid : 'nincs értelmes id');
        $dataToModify = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees WHERE `employeeNumber` = '$tid'") or die(mysqli_error($dblink));
        $row = mysqli_fetch_assoc($dataToModify) or die(mysqli_error($dblink));
        //var_dump($row);
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

            mysqli_query($dblink, "UPDATE employees SET `firstName`='$modifiedData[keresztnev]', `lastName`='$modifiedData[vezeteknev]', `extension`='$modifiedData[mellek]', `email`='$modifiedData[email]' WHERE `employeeNumber` = '$tid'") or die(mysqli_error($dblink));

            echo '<p style="color: red;">Az adat sikeresen módosítva lett.</p>';
        }
        break;
    case 'new':
        echo '<a href="?act=list">Vissza</a> | <h2>Új felvitel</h2>';
        echo
        '<form method="post">
            <label for="azonosito">Azonosító</label>
            <br/>
            <input type="text" name="azonosito" placeholder="1234" size="30">
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
            <input type="text" name="email" placeholder="kminta@classicmodelcars.com" size="30">
            <br/><br/>
            <input type="submit" name="submit" value="Rögzít">

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
             $data = filter_input_array(INPUT_POST, $customFilter, $add_empty = false);

             //echo '<pre>';
             //var_dump($data);
             //echo '</pre>';


             // végül ez nem lett használva, mert egyszerűbb megoldás is akadt
             //$tablaAdat = filter_var_array($beirtAdat, $customFilter);

             //echo '<pre>';
             //var_dump($tablaAdat);
             //echo '</pre>';

             //echo $data['keresztnev'];
             mysqli_query($dblink, "INSERT INTO employees(`employeeNumber`, `firstName`, `lastName`, `extension`, `email`) VALUES ('$data[azonosito]', '$data[keresztnev]', '$data[vezeteknev]', '$data[mellek]', '$data[email]')") or die(mysqli_error($dblink));
             //mysqli_query($dblink, "INSERT INTO employees(`employeeNumber`, `firstName`, `lastName`, `extension`, `email`) VALUES ('9999', 'Elek', 'Teszt', 'x9876', 'elek.teszt@minta.hu')") or die(mysqli_error($dblink));
             echo '<p style="color: red;">Record has been added succesfully.</p>';
         }
    // INNEN SZÁNDÉKOSAN HIÁNYZIK A BREAK??

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
                . "<td>{$row['firstName']} {$row['lastName']}</td>"
                . "<td>{$row['extension']}</td>"
                . "<td>{$row['email']}</td>"
                . "<td><a href='?act=mod&amp;tid={$row['employeeNumber']}''>Módosít</a> | <a href='?act=del&amp;tid={$row['employeeNumber']}'>Töröl</a></td>"
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
