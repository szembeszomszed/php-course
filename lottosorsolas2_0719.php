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
        // állandó tippekre tömböt felvenni állandó számokkal
        // eljárás, ami képes véletlen számokat generálni
        // véletlentippek tömbbe generáljuk a számokat
        // egy harmadikba lesz legenerálva maga a sorsolás eredménye
        // egy eljárásban generáljuk le a 3 tömb adatait
        
        /* ENYÉM - NEM MŰKÖDIK
        $allando_tippek = [1, 49, 55, 77, 83];
        $veletlen_tippek = tipp($limit, $huzasok_szama);
        $sorsolt_szamok = sorsolas($limit, $huzasok_szama);
        
        $limit = 90;
        $huzasok_szama = 5;
        
        
        
        echo 'Az állandó tippek: '.implode(', ', $allando_tippek);
        echo '<br/>';
        echo 'A véletlen tippek: '.implode(', ', $veletlen_tippek);
        echo '<br/>';
        echo 'A sorsolás eredménye: '.implode(', ', $sorsolt_szamok);
        echo '<br/>';
        
        
        function tipp($limit = 45, $huzasok_szama = 6) {
            
            $veletlen_tippek = [];
            
            if ($limit < $huzasok_szama) {
                die("próbáld újra!");
            }
            while (count($veletlen_tippek) < $huzasok_szama) {
                $veletlen_tippek[] = rand(1, $limit);
                $veletlen_tippek = array_unique($veletlen_tippek);
            }
                        
            sort($veletlen_tippek);
            
            return $veletlen_tippek;
        }
        
        function sorsolas($limit, $huzasok_szama) {
            
            $sorsolt_szamok = [];
            
            if ($limit < $huzasok_szama) {
                die('hiba a sorsoláskor - próbáld újra!');
            }
            
            while (count($sorsolt_szamok) < $huzasok_szama) {
                $sorsolt_szamok[] = rand(1, $limit);
                $sorsolt_szamok = array_unique($sorsolt_szamok);
            }
                        
            sort($sorsolt_szamok);
            
            return $sorsolt_szamok;  
            
            
        }
         
         
         */
        
        $allando = [1, 2, 3, 4, 5, 6]; //állandó tippek tömbje
        $limit = 90;
        $huzasok_szama = 5;
        $tippek = veletlenszam();
        echo '<br/>A tippek: '.implode(', ', $tippek);
        echo '<br/>Az állandó tippek: '.implode(', ', $allando);
        $sorsolas = veletlenszam();
        echo '<br/>A sorsolás eredménye: '.implode(', ', $sorsolas);
        
        // nézzük meg, hogy a 2 tömbben akad-e egyezés
        
        $talalatok = array_intersect($tippek, $sorsolas);
        $talalatok_szama = count($talalatok);
        //ha volt találatom, írjuk ki, hogy mennyi és mi
        if($talalatok_szama > 0) {
            echo '<h2> Gratulálunk! Ön a véletlenül generált tippjeivel eltalált '.$talalatok_szama. ' számot, mely(ek) a következő(k): '.implode(', ',$talalatok).'.</h2>';
        } else {
            echo '<h2 style="color: red;">Sajnálom, nem nyert.</h2>';
        }
        
        // nézzük meg az állandó tippekre is
        $talalatok = array_intersect($allando, $sorsolas);
        $talalatok_szama = count($talalatok);
        if($talalatok_szama > 0) {
            echo '<h2> Gratulálunk! Ön az állandó tippjeivel eltalált '.$talalatok_szama. ' számot, mely(ek) a következő(k): '.implode(', ',$talalatok).'.</h2>';
        } else {
            echo '<h2 style="color: red;">Sajnálom, nem nyert.</h2>';
        }
               
        
        ?>
    </body>
</html>

<?php

    function veletlenszam($limit= 90, $huzasok_szama = 5) {
        if($limit < $huzasok_szama) {
            die("rossz paraméterezés");
        }
        
        $tomb = [];
        while (count($tomb) < $huzasok_szama) {
            $tomb[] = rand(1, $limit);
            $tomb = array_unique($tomb);
        }
        
        sort($tomb);
        return $tomb;
    }

?>
