<!DOCTYPE html>
<!--
12) Írjunk egy PHP szkriptet ami stringet tömbbe rak
	Példa adat: Édes álom libben\nkönnyű szárnyon,\ncsöndes éjjel szép\nszemedre szálljon!
	Output dumppal: array(4) { [0]=> string(30) "Édes álom libben" 
	[1]=> string(26) "könnyű szárnyon," [2]=> string(27) "csöndes éjjel szép" 
	[3]=> string(26) "szemedre szálljon!" } 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $szoveg1 = "Édes álom libben<br/>könnyű szárnyon,<br/>csöndes éjjel szép<br/>szemedre szálljon!";
        
        //az explode() szöveget alakít tömbbé, így hát az implode() ellentéte ő
        $tomb1 = explode("<br/>", $szoveg1);
        
        echo '<pre>';
        var_dump($tomb1);
        echo '</pre>';
        
        // .csv fájlok feldolgozásakor jól jön ez a funkció - ;-re lehet rákeresni szépen
        ?>
    </body>
</html>
