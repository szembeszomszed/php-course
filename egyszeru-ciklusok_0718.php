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
        
        //elöltesztelő ciklus
        echo "<p>";
        $szamlalo = 1;
        while ($szamlalo < 10) {
            echo 'abc';
            $szamlalo++;
        }
        echo "</p>";
        
        //hátultesztelő ciklus
        
        echo '<p>';
        $szamlalo = 1;
        
        do {
            echo 'xyz';
            $szamlalo++;
        } while ($szamlalo < 10);
        echo "</p>";
        
        // for ciklus
        // for(kezdeti érték; be- kilépési feltétel; ciklusváltozó növelése)
        // ha a ciklusvltozót fel akarom használni, akkor for ciklust hazsnálon
        // ha nem szeretném felhasználni, mert csak egy feltétel kell, akkor while
        
        echo '<p>';
        for($x=1;$x < 10; $x++) {
            echo "$x "; // idézőjelekre figyeljünk, ha változót íratunk ki
        }
        
        echo "</p>";
        
        //írjunk egy sorszámozott listát, ami a következőt írja ki:
        // 1. elem A
        // 2. elem B
        // 3. elem C...
        //... elem G
        
        //A BETŰKNEK IS VAN ÉRTÉKÜK, TEHÁT LEHET ŐKET IS LÉPTETNI SZÉPEN
        
        echo "<p>";
        
        echo "<ol>";
                
        for ($i = 'A'; $i < 'H'; $i++) {
            echo "<li>Elem $i</li>";
        }
        
        echo "</ol>";
        echo "</p>";
        
        
        echo "<table> 
            <thead>
                <tr>
                    <th>Első szám</th>
                    <th>Művelet</th>
                    <th>Második szám</th>
                    <th>Eredmény</th>
                </tr>
            </thead>
            <tbody>";               
     
        
        for($i = 1; $i <13; $i++) {
            $num1 = $i;
            $num2 = $i;
            $result = $i * $i;
            
            echo "<tr>";            
        }
        
        
        
        
        
        ?>
    </body>
</html>
