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
        // Saját eljárás készítése - többször felhasználható és paraméterezhető programrész
        
        $limit = 45;
        $huzasok_szama = 6;
        $sorsolt = sorsolas($limit, $huzasok_szama); //eljárás meghívását követően az adott paraméterekkel hívjuk meg
        var_dump($sorsolt); 
        echo '<br/>';
        $sorsolt = sorsolas(); // paraméterek nélkül hívjuk meg
        var_dump($sorsolt);
        echo '<br/>';
        $rossz_limit = 90;
        $rossz_huzasok = 'karcsi';
        $rossz_sorsolt = sorsolas($rossz_limit, $rossz_huzasok);
        var_dump($rossz_sorsolt);
        echo '<br/>';
        
        function sorsolas($limit = 90, $huzasok_szama = 5) { // a paramétert bárhogy nevezhetjük!
            // két paramétert adtunk meg default értékkel, így akár 0 v 1 paraméterrel is meghívható az eljárás
            $szamok = array();
            
            // hülyebiztos védelem kialakítása
            if($limit < $huzasok_szama || gettype($limit) == 'string' || gettype($huzasok_szama) == 'string') { // a gettype-ot csak én adtam hozzá
                return FALSE; // hamis boolean visszatérési értékkel RÖGTÖN kilép az eljárásból
                //die('rossz paraméter a sorsolás eljárásban'); // azonnal megállít minden futást
                // EGYSZERRE CSAK EGY ILYET HASZNÁLJUNK! tehát vagy return FALSE vagy die()
            } // if vége - else ág itt nem szükséges
            
            // számok generálása
            while(count($szamok) < $huzasok_szama) { // amíg a $szamok kisebb marad, mint a $huzasok_szama
                $szamok[] = rand(1, $limit);
                $szamok = array_unique($szamok); //már a ciklusban törli az egyforma számokat
            } // while vége
            
            sort($szamok); // a sorbarendezést nyugodtan lehet a cikluson kívül is elvégezni
            return $szamok; // az eljárás a $szamok-kal tér vissza
        }
        
        ?>
    </body>
</html>
