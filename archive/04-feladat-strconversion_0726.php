<!DOCTYPE html>
<!--
4) Készítsünk egy PHP szkriptet ami egy változót stringgé konvertál
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $szam = 10; //a $szam változó egy integer
        echo '<pre>';
        var_dump($szam);
        echo '</pre>';
        
        //$szoveg = $szam; // így is integer maradna
        
        //típuskényszerítéssel tudom megadni a kívánt formátumot
        $szoveg = (string)$szam;
        echo '<pre>';
        var_dump($szoveg);
        echo '</pre>';
        
        // ha már kész programokkal kell a scriptünket harmonizálni, meg kell nézni, hogy az a program
        // milyen típusú változókat generál
        
        
        
        
        
        ?>
    </body>
</html>
