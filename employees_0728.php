<?php

// csatlakozás a db-hez
// ezúttal már változókba vesszük fel a lényeges paramétereket

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'classicmodels';

// adatbáziskapcsolat felépítése a mysqli használatával
// mysql és mysqli függvények nem vegyíthetők egymással

$dblink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
        or die('<h2>Nincs kapcsolat, hívd a rendszergazdát, vagy kezdj el imádkozni</h2>');
$dbselect = mysqli_select_db($dblink, $dbname) or die(mysqli_error());


// kódlapra illesztjük az adatbázist az ékezetes karakterek miatt
mysqli_set_charset($dblink, 'utf-8');

// URL-paraméterek beállítása

// url-ből érkező karaktersorozatot mindig meg kell tisztítani!

if (filter_input(INPUT_GET, 'act')) { // így itt a majdani 'act' kulcsra keresünk
    $action = filter_input(INPUT_GET, 'act');
} else {
    $action = 'list'; // az else ágba mehetne hibaüzenet is, de ehelyett itt adunk egy alapértéket a változónak
}

if(filter_input(INPUT_GET, 'tid', FILTER_VALIDATE_INT)) { // tid itt -> termék id - és ez csak szám lehet majd
    $tid = filter_input(INPUT_GET, 'tid', FILTER_VALIDATE_INT);
} else {
    $tid = NULL; // ellenkező esetben teljesen üres értéket adunk neki, tehát ez így egy típus nélküli üres változó (ez nem egyenlő a ""-gel, mert az egy üres string volna)
}

// Switch elágazás készítése az egyszerű esetek leválasztására

switch ($action) {
    case 'del':
        $output = '<a href="?act=list">Vissza</a> | '; // ha nem linket teszek href-nek, hanem kérdőjel után paramétert, akkor önmagát fogja meghívni
        $output .= ( $tid ? "Törlünk: ".$tid : 'nincs értelmes id');
        break;
    case 'mod':
        $output = '<a href="?act=list">Vissza</a> | <h2>Módosítunk</h2>';
        break;
    case 'new':
        echo '<a href="?act=list">Vissza</a> | <h2>Új felvitel</h2>'; // $output-ot is használhatnánk, de itt most echozunk
    default:
        /*************Listázás**************/
        $eredmeny = mysqli_query($dblink, "SELECT `employeeNumber`, `firstName`, `lastName`, extension, email FROM employees") or die(mysqli_error($dblink)); // a súgó a jelek szerint nem mindenhova tesz ``-t
        $output = '<a href="?act=new">Új felvitel</a>' // a linkben a new kulcsszót az act-be tesszük bele, így paraméterezzük a linket. 
                . '<table border="1" style="border-collapse: collapse;">'
                . '<tr>'
                . '<th>Azonosító</th>'
                . '<th>Név</th>'
                . '<th>Mellék</th>'
                . '<th>Email</th>'
                . '<th>Művelet</th>'
                . '</tr>';
        // sorok feltöltése ciklus segítségével
        while ($row = mysqli_fetch_assoc($eredmeny)) {
            $output .= "<tr>"
                    . "<td>{$row['employeeNumber']}</td>" // a {} csak szeparál itt, hogy használhassuk a ""-t
                    . "<td>{$row['firstName']} {$row['lastName']}</td>"
                    . "<td>{$row['extension']}</td>"
                    . "<td>{$row['email']}</td>"
                    . "<td><a href='?act=mod'>Módosít</a> | <a href='?act=del&amp;tid={$row['employeeNumber']}'>Töröl</a></td>"
                    . "</tr>"; // az url-be betettük a művelet tárgyát, a törölhöz termék id-t is csapunk 
                                // az & jelnek a kódját írtuk be a biztonság kedvéért (ez az &amp)
                                // a gyakorlatban ez így néz ki: http://localhost/0728/MySQL/employees.php?act=del&tid=1002
        }
        $output .= '</table>';
        break;
}

// példa a linkek paraméterezésének lényegére
// pl a főoldalon kilistázunk akciós termékeket
// és ezeket a termékeket akarjuk linkelni
// csinálunk egy termékek oldalt, ahova betöltetjük a a kiválasztott termékek adatait
// ezen az oldalon megnézzük, hogy a GET-ben megvan-e az a kulcs, ami a kiválasztott termékhez tartozik
// ha igen, akkor megjelenítjük szépen
// mindig a ? után paraméterezzük az url-t, mégpedig az alábbi szintaktikával (lásd feljebb is):
// ?szuperglobálistömbkulcsa=hozzátartozóérték
// és akkor így néz majd ki pl egy link: http://localhost/0728/MySQL/employees.php?act=new

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


/* SAJÁT MEGOLDÁS
 * 
 * //név és email lekérdezése
// ezek az oszlopok kellenek:
    // azonosító employee number
    // név lastName
    // mellék extension
    // emailcím
    // művelet

$result = mysqli_query($dblink, "SELECT * FROM employees") or die(mysqli_error($dblink));

echo '<table border="1" width="100" style="border-collapse: collapse;">';
echo '<tr><th>Azonosító</th><th>Vezetéknév</th><th>Keresztnév</th><th>Mellék</th><th>Email</th><th>Művelet</th></tr>';

while ($row = mysqli_fetch_array($result)) {
    echo '<tr><td>';
    echo $row['employeeNumber'];
    echo '</td>';
    echo '<td>';
    echo $row['lastName'];
    echo '</td>';
    echo '<td>';
    echo $row['firstName'];
    echo '</td>';
    echo '<td>';
    echo $row['extension'];
    echo '</td>';
    echo '<td>';
    echo $row['email'];
    echo '</td>';
    echo '<td>';
    echo '<button>Művelet</button>';
    echo '</td></tr>';
}

echo '</table>';
 * 
 * 
 */





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
