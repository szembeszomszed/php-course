<!DOCTYPE html>
<!--
1) Írjunk egy eljárást, ami egy számnak kiszámolja a faktoriális értékét
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        function faktorialis($n) {
            if ($n == 0) {
                return 1;
            } else {
                return $n * faktorialis($n - 1); 
                // mivel az eljárás meg tudja hívni magát, olyan, mintha loopot használnánk
                // az eljárás így körbeforog egy ciklusban, mindig 1-gyel csökkentve az $n-t
                // addig fogja meghívni magát, amíg az $n nem éri el a 0-t - amint eléri, 1-gyel tér vissza
                // így nem nullázódik le a szorzat
            }
        }
        
        echo faktorialis(4);


        ?>
    </body>
</html>
