<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Színek és számok</title>
        <style>
            body {background-color: #cecece}; // itt adjuk meg a hátteret szépen
        </style>
    </head>
    <body>
        <?php
        // Generáljunk le 1-500 számokat, és rand fgv használata nélkül oldjuk meg a változó (de nem random!) színeket
        // tehát kiíratunk számokat, és minden számnak más lesz a színe
        for ($i = 1; $i <= 500; $i++) {
            
            // csonka if - nincs else ága
            $r = 0;
            if ($i % 2 == 0) {
                $r = 255;
            }
            
            // if-else
            if ($i % 3 == 0) {
                $g = 255;
            } else {
                $g = 0;
            }
            
            // if-else és a short if szerkezet:
            
            //feltétel ? IGAZ ÁG : HAMIS ÁG
            
            $b = ($i % 5 == 0 ? 255 : 0); // átláthatóbb, mint a hagyományos if-szerkezet
            
            
            /* másképpen, nem short if-fel:
            if($i % 5 == 0) {
                $b = 255;                
            } else {
                $b = 0;
            }            
            */
            
            echo "<div style=\"color: rgb($r, $g, $b);\">$i</div>";
            
            //másképpen, aposztróffal:
            //echo '<div style="color: rgb('.$r.','.$g.','.$b.')">'.$i.'</div><br/>';
        }
        ?>
    </body>
</html>
