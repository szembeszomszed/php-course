<!DOCTYPE html>
<!--
21) Írjunk egy php szkriptet ami eltávolítja a / jeleket
	Példa adat: 'A róka nagyon gyorsan ugrik, és aki az erdőben él és ugrik///'
	Output: 'A róka nagyon gyorsan ugrik, és aki az erdőben él és ugrik.'
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $szoveg = 'A róka nagyon gyorsan ugrik, és aki az erdőben él és ugrik///';
        
        echo rtrim($szoveg, "/");
        ?>
    </body>
</html>
