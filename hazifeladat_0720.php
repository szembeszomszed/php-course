<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h2>Gombnyomásra váltakozó tartalom</h2>
        <br/>
        <form method="post">
            <input type="radio" name="tartalom" value="urlap" id="urlap">
            <label for="urlap">Űrlap</label>
            <input type="radio" name="tartalom" value="tablazat" id="tablazat">
            <label for="tablazat">Táblázat</label>
            <input type="radio" name="tartalom" value="foto" id="foto">
            <label for="foto">Fotó</label>
            <input type="submit" name="submit" value="Lássuk">
        </form>
    </body>
</html>

<?php

if (filter_input(INPUT_POST, 'submit')) {    
    $choice = filter_input(INPUT_POST, 'tartalom');
    //var_dump($choice);
    echo '<br/><br/>';
    switch ($choice) {
        case 'urlap':
            echo '
            <form method="get">
                <fieldset>
                    <legend>Felhasználói adatok</legend>
                    <label for="vezetek">Vezetéknév</label>
                    <input type="text" name="vezetek" placeholder="Vezetéknév"/>
                    <br/>
                    <label for="kereszt">Keresztnév</label>
                    <input type="text" name="kereszt" placeholder="Keresztnév"/>
                    <br/>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email"/>
                </fieldset>
                    <input type="submit" name="submit" value="Elküld"/>

            </form>

            ';
            break;
        case 'tablazat':
            echo '<table border="1px" style="border-collapse: collapse;">';
            for ($i = 1; $i <= 10; $i++) {
                echo '<tr>';
                for ($j = 1; $j <= 10 ; $j++) { 
                    echo "<td>karcsi</td>";
                }
                echo '</tr>';
            }
            echo '</table>';
            break;
        case 'foto':
            echo '<img src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xpt1/v/t1.0-9/11181959_522462921254191_5314616741948243386_n.jpg?oh=258b3243fcd8f1da4847b51f13fe8f20&oe=57EEAFF8&__gda__=1479012092_8243129a161044e92b30dc529b715b91"/>';
            break;    
        default:
            echo "";
            break;
    }
}




?>