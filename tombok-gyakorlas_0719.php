<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $tomb = array(); // Üres tömb
        $tomb = array('alma', 1, true, 7/8); // automatikus indexre kerülnek az elemek
        var_dump($tomb);
        echo '<br/>';
        $elemszam = count($tomb);
        echo 'A tömb nulladik kulcson található értéke: '.$tomb[0];
        echo '<br/>';
        //echo $tomb; // echo-val számot, stringet íratunk ki - tömböt nem tudunk!!
        echo implode(', ',$tomb);
        echo '<br/>';
        $tomb[] = 'Új elem'; // soron következő indexre pakol automatikusan
        $tomb[100] = '100. index'; // a 100. indexre pakol
        var_dump($tomb);
        echo '<br/>';
        
        // ASSZOCIATÍV ELEMBŐVÍTÉS 
        
        $tomb['email'] = 'email@cim.hu';
        $tomb['admin'] = 'Superadmin';
        $tomb[] ='valami'; // az utolsó indexre pakol
        var_dump($tomb);
        echo '<br/>';
        /**********************/
        
        $tomb = []; // a tömböt újradeklaráljuk üres tömbként, és az értékei törlődnek
        // ez nem ugyanaz, mint az unset, hiszen itt gyakorlatilag új tömböt kezdünk
        
        $tomb = [1, 2, 3, 4, 5, 5, 5, 5, 5, 6, 7, 7, 7, 8];
        echo '<br/>';
        var_dump($tomb);
        echo '<br/>';
        echo 'A tömb értékeinek a maximuma: '.max($tomb);
        echo '<br/>';
        echo 'A tömb értékeinek a minimuma: '.min($tomb);
        echo '<br/>';
        echo 'A tömb értékeinek átlaga: '.array_sum($tomb) / count($tomb);
        echo '<br/>';
        
        // Ismétlődő értékek eltávolítása
        
        $egyedi_tomb = array_unique($tomb); // az array_unique() NEM KULCSOLJA ÚJRA A TÖMBÖT!
        var_dump($egyedi_tomb);
        echo '<br/>';
        
        // feladat: 3 különböző véletlen szám előállítása 1 és 20 között
        
        $szamok = []; // üres tömb a számoknak
        
        
        for(;count($szamok) < 3;) { // ki is lehet hagyni a nem kívánt paramétereket
            $szamok[] = rand(1, 20);
            $szamok = array_unique($szamok);
        }
        
        var_dump($szamok);
        echo '<br/>';
        
        // a for felesleges, mert a ciklusváltozót nem használom fel!
        
        // öt szám kiíratása for és while ciklussal
        
        for ($i = 1; $i <= 5; $i++) {
            echo $i;
        }
        
        echo '<br/>';
        
        $i = 1; // jelen esetben újra kellett deklarálni az $i-t, különben nem lépett volna be a ciklusba
        while ($i <= 5) {
            echo $i;
            $i++;
        }
        
        
        

        
        
        
        ?>
    </body>
</html>
