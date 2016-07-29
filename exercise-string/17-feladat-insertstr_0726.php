<!DOCTYPE html>
<!--
17) Írjunk egy PHP szkriptet ami beilleszt egy stringet a meglévőbe
	Példa adat: 'A barna róka'
	illesszük be a 'gyors' szót az 'A' és a 'barna' közé
	Output: 'A gyors barna róka'
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $str = 'A barna róka';
        $stringToInsert = 'gyors';
        
        //a substr_replace() -> egy meglévő karaktersorozatba illeszt be egy másikat
        
        echo substr_replace($str, $stringToInsert, 0).'<br/>';
        echo substr_replace($str, $stringToInsert, 0, 0).'<br/>';
        echo substr_replace($str, $stringToInsert, 0, 1).'<br/>';
        
        //és akkor ez a jó megoldás - ügyesen egy space-t is hozzáfűztünk a beillesztendő stringhez
        echo substr_replace($str, $stringToInsert.' ', 2, 0).'<br/>';
        ?>
    </body>
</html>
