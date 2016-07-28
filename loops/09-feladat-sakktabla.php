<!DOCTYPE html>
<!--
9) Készítsünk sakktáblát 270pxes tábla szélességben 30pxes cellamagassággal
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="1" width="270px" style="border-collapse: collapse;">
        <?php
        
        /*
        for ($i = 1; $i <= 8; $i++) {
            echo '<tr>';
            for ($j = 1; $j <= 8; $j++) {
                if($i % 2 == 1 && $j % 2 == 1) {
                    echo '<td height="30" style="background-color: white;"></td>';
                } elseif ($i % 2 == 1 && $j % 2 == 0) {
                    echo '<td height="30" style="background-color: black;"></td>';
                } elseif ($i % 2 == 0 && $j % 2 == 1) {
                    echo '<td height="30" style="background-color: black;"></td>';
                } elseif ($i % 2 == 0 && $j % 2 == 0) {
                    echo '<td height="30" style="background-color: white;"></td>';
                }
            }
            echo '</tr>';
        }
        */
        
        for ($sor = 1; $sor <= 8; $sor++) {
            echo '<tr>';
            for ($oszlop = 1; $oszlop <= 8; $oszlop++) {
                $osszesen = $sor + $oszlop;
                if ($osszesen % 2 == 0) { // a táblázat föntről, az a8 mezőből indul, ezért kezdődik fehérrel :)
                    echo '<td width="30" height="30" bgcolor="white"></td>';
                } else {
                   echo '<td width="30" height="30" bgcolor="black"></td>'; 
                }
            }
            echo '</tr>';
        }
        ?>
        </table>
    </body>
</html>
