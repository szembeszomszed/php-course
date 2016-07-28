<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tömbök gyakorlása</title>
    </head>
    <body>
        <?php
        // készítsünk egy 30 elemű tömböt, feltöltve 1-100-ig véletlen számokkal
        //a) a tömb értékeinek a maximumát írassuk ki
        //b) a tömb értékeinek a minimumát írassuk ki
        echo '<h2>30 elemű tömb, véletlenszerűen feltöltve for ciklussal</h2>';
        $myArray = array();
        $myArray2 = array();
        
        for($i = 0; $i < 30; $i++) {
            $myArray[$i] = rand(1, 100);
        }
        
        var_dump($myArray);
        echo '<br/>';
        
        echo 'A tömb értékeinek maximuma: '.max($myArray).'<br/>';
        echo 'A tömb értékeinek minimuma: '.min($myArray).'<br/>';
        echo 'A tömb értékeinek összege: '.array_sum($myArray).'<br>';
        echo 'A tömb értékeinek átlaga: '.array_sum($myArray) / count($myArray).'<br/>';
        
        $egyedi = array_unique($myArray);
        echo '<br/>';
        var_dump($egyedi);
        
        //másik megoldás while-lal, ahol már nem kell ciklusváltozó
        
        echo '<h2>30 elemű tömb, véletlenszerűen feltöltve while ciklussal</h2>';
        while(count($myArray2) <= 30) {
            $myArray2[] = rand(1, 100);
        }
         
         
        
        var_dump($myArray2);
        echo '<br/>';
        
        echo 'A tömb értékeinek maximuma: '.max($myArray2).'<br/>';
        echo 'A tömb értékeinek minimuma: '.min($myArray2).'<br/>';
        echo 'A tömb értékeinek összege: '.array_sum($myArray2).'<br>';
        echo 'A tömb értékeinek átlaga: '.array_sum($myArray) / count($myArray2).'<br/>';     
        
        $egyedi = array_unique($myArray2);
        echo '<br/>';
        var_dump($egyedi);
        
        // array, 50-es indextől feltöltve - itt már for-t kell használni
        echo '<h2>30 elemű tömb, véletlenszerűen feltöltve az 50-es indextől for ciklussal</h2>';
        $myArray3 = [];
        for($i = 50; $i<=80; $i++) {
            $myArray3[$i] = rand(1, 100);
        }
        
        var_dump($myArray3);
        echo '<br/>';
        
        echo 'A tömb értékeinek maximuma: '.max($myArray3).'<br/>';
        echo 'A tömb értékeinek minimuma: '.min($myArray3).'<br/>';
        echo 'A tömb értékeinek összege: '.array_sum($myArray3).'<br>';
        echo 'A tömb értékeinek átlaga: '.array_sum($myArray) / count($myArray3).'<br/>';
        

         
         
        

        ?>
    </body>
</html>
