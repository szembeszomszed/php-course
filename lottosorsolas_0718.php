<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo '<h2>Lottósorsolás - én megoldásom:</h2>';
        $szamok = [];
        $egyedi = [];
        
        while(count($egyedi) < 5) {
            $szamok[] = rand(1, 90); 
            $egyedi[] = array_unique($szamok);
        }
        
        var_dump($egyedi);
        echo '<br/>';
        
        
        sort($egyedi);
        var_dump($egyedi);
        echo '<br/>'; 
        
        echo '<h4>A nyertes számok: </h4>';
        for($i = 0; $i < 5; $i++) {
            echo $egyedi[$i]. " "; // nem működik valamiért
        }
        
        echo '<h2>Lottósorsolás - közös megoldás:</h2>';
        $tomb = [];
        while(count($tomb) < 5) { //figyeljünk a kilépési értékre!
            $tomb[] = rand(1, 90);
            $tomb = array_unique($tomb);
        }
        
        sort($tomb);
        
        
        echo '<h4>A nyertes számok: </h4>';
        for($i = 0; $i < count($tomb); $i++) {
            echo $tomb[$i].", ";
        }
        echo '<br/>';
        
        echo 'A nyertes számok szebben és gyorsabban kiíratva: '.implode(', ', $tomb);
        
        ?>
    </body>
</html>
