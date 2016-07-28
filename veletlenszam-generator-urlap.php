<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h2>Véletlenszám-generátor űrlap segítségével</h2>
        <form method="get">
            <fieldset>
                <legend>Véletlenszám-generátor</legend>
                <label for="darabszam">Add meg, hány darab véletlenül generált számot szeretnél látni!</label>
                <input type="number" name="darabszam" placeholder="12345">
                <br/>
                <label for="alsolimit">Add meg az alsó határmezsgyét!</label>
                <input type="number" name="alsolimit" placeholder="12345">
                <br/>
                <label for="felsolimit">Add meg a felső határmezsgyét!</label>
                <input type="number" name="felsolimit" placeholder="12345">
            </fieldset>
            <input type="submit" name="submit" value="Generálj!"" style="margin-left: 530px;">
        </form>
        <br/>
    </body>
</html>

<?php
    if(filter_input(INPUT_GET, 'submit')) {
        $darabszam = filter_input(INPUT_GET, 'darabszam');
        $alsolimit = filter_input(INPUT_GET, 'alsolimit');
        $felsolimit = filter_input(INPUT_GET, 'felsolimit');
        szamgenerator($darabszam, $alsolimit, $felsolimit);
    }

    function szamgenerator($darab, $also, $felso) {

        echo '<p>A kért darabszám: '.$darab.'<br/>Az alsó mezsgye: '.$also.'<br/>A felső mezsgye: '.$felso.'<br/>';

        if ($felso - $also < $darab || $also > $felso || $darab < 1 ) {
            echo '<ul style="color: red;">HIBA! Az alábbiakra ügyelj: 
                <li>legalább 1 számot kell generálnunk</li>
                <li>a darabszám nem lehet nagyobb, mint a két mezsgye közti különbség</li>
                <li>az alsó mezsgye nem lehet nagyobb, mint a felső.</li>
                </ul>';
            die();
        } 

        $szamok = [];
        while (count($szamok) < $darab) {
            $szamok[] = rand($also, $felso);
            $szamok = array_unique($szamok);
        }

        sort($szamok);
        echo '<p>Íme a számok: '.implode(', ', $szamok);
    }
?>