<!DOCTYPE html>
<!--
2) Írjunk egy PHP szkriptet ami
	Példa adat: '082307'
	Output: 08:23:07
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $szoveg1 = '082307';
        //substr() az adott karakterlánc egy meghatározott részével tér vissza
        //chunk_split() darabolja a stringet, be is tud ékelni karaktereket a stringbe
        
        echo substr(chunk_split($szoveg1,2,':'),0,-1);
        //a -1 levágja a végéről az utolsó karaktert, így a chunk_split() által odacsűrt : is lekerül
        
        // pl .csv fájl készítésekor hasznos, mert ott a szöveg ;-kkel tagolt
       
        ?>
    </body>
</html>
