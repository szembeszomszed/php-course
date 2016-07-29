<!DOCTYPE html>
<!--
23) Írjunk egy php szkriptet ami kicseréli a karaktereket az alábbi példában
	Pálda adat: '\"\1+2/3*2:2-3/4*3'
	Kimenet:  '1 2 3 2 2 3 4 3'
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $data = '\"\1+2/3*2:2-3/4*3';
        
        //a str_replace() nem csak stringet, hanem tömböt is elfogad, ezért 'mixed'
        echo str_replace(str_split('\"+/*:-/'), ' ', $data);
        // reguláris kifejezésekkel egyébként megoldható, hogy ne kelljen felsorolni a nem kívánt karaktereket
        
        ?>
    </body>
</html>
