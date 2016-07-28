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
        // szorozzuk össze a számokat 1-12-ig
        
             
     
        
        for($i = 1; $i <13; $i++) {
           $eredmeny = $i * $i;
           
           echo "$i * $i = $eredmeny<br/>";            
        }
        
        //szorzótábla
        
        echo "<h2>Beágyazott ciklusú szorzótábla</h2>";
        
        //html táblázat készítése
        
        echo "<table border=1px>"; // a table még a loop-on kívül kezdődik
        
        // táblázat adatainak legenerálása 1-10 számokkal, önmagukkal megszorozva
        // kezdjük a sorokkal
        
        for($sor = 1; $sor <= 10; $sor++) {
            echo '<tr>'; // az első loop-pal csak sorokat generálunk
            for($oszlop = 1; $oszlop <= 10; $oszlop++) {
                //először a matek
                $eredmeny = $sor * $oszlop; 
                //a szorzas tehát a változó aktuális értéke alapján történik
                //az értékeket táblázatba rakom
                echo "<td>$eredmeny</td>";
                //és egyszerűen kiíratom az eredményt
                //az első sor nem fejléc, hanem már a szorzótábla első sora
            }
            echo '</tr>'; // az első loop-ban zárjuk le az ott megkezdett tr-t
        }
        
        echo '</table>'; 
        ?>
    </body>
</html>
