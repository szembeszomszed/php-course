<!DOCTYPE html>
<!--
20) Írjunk egy php szkriptet ami eltávolít egy szót a szövegből
	Példa adat: 'A róka nagyon gyorsan ugrik, és aki az erdőben él és ugrik.'
	Távolítsuk el a róka szót
	Output: 'A nagyon gyorsan ugrik, és aki az erdőben él és ugrik.'
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $text = 'A róka nagyon gyorsan ugrik, és aki az erdőben él és ugrik.';
        $stringToRemove = "róka";
        
        echo str_replace($stringToRemove, "", $text);
               
        ?>
    </body>
</html>
