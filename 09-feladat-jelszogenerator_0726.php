<!DOCTYPE html>
<!--
9) Írjunk egy PHP szkriptet ami egy random jelszót generál (ne használjuk a rand() fgv-t)
	Példa adat: '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'
	Figyelem: A jelszó hossza lehet 6, vagy 7, vagy 8 is
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        function jelszoGenerator($szam) {
            $adatok = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            // a str_shuffle megkeveri a string karaktereit
            return substr(str_shuffle($adatok), 0, $szam);
        }
        
        echo jelszoGenerator(6).'<br/>';
        echo jelszoGenerator(7).'<br/>';
        echo jelszoGenerator(8).'<br/>';
        echo jelszoGenerator(9).'<br/>';
        echo jelszoGenerator(10).'<br/>';
        
        
        ?>
    </body>
</html>
