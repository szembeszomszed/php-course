<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h2>1. feladat: űrlapba beírt szám felhasználása</h2>
        <form method="get">
            <fieldset>              
                <legend>Pozitív szám és név</legend>
                <label for="a">Adj meg egy tetszőleges pozitív egész számot és a neved!</label>
                <input type="number" name="num" placeholder="12345"/>
                <input type="text" name="name" placeholder="name"/>
            </fieldset>
            <input type="submit" name="submit" value="Rajta" style="margin-left: 693px;">
        </form>
        <br/>
        
    </body>
</html>

<?php

    if(filter_input(INPUT_GET, 'submit')) {
        $szam = filter_input(INPUT_GET, 'num');
        $nev = filter_input(INPUT_GET, 'name');
        //echo $_GET["a"];

        echo "Szervusz <strong>$nev</strong>! Íme a neved <strong>$szam</strong> alkalommal leírva: <br/> <br/>";
        for($i = 1; $i <= $szam; $i++) {
            echo "$nev ";
        }
    }

    //var_dump($_GET);

?>



