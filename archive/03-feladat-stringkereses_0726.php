<!DOCTYPE html>
<!--
3) Írjunk egy PHP szkriptet ami leellenöriz egy szót a szövegben
	Példa adat: 'A róka nagyon gyors, és szinte bármit átugrik.'
	Ellenörizzünk rá a szinte szóra
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $szoveg1 = 'A róka nagyon gyors, és szinte bármit átugrik.';
        $szo = 'róka';
        
        if(strpos($szoveg1, $szo) != FALSE) { //sima TRUE vizsgálat is működik, de így kicsit látványosabb
            echo "a $szo szó szerepel";
        } else {
            echo "a $szo szó nem szerepel";
        }
        
        ?>
    </body>
</html>
