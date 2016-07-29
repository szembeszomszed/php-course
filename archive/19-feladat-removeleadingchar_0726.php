<!DOCTYPE html>
<!--
19) Írjunk egy php szkriptet ami eltávolítja a vezető nullákat
	Példa adat: '000547023.24'
	Output: '547023.24'
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $adat = '000547023.24';
        // a trim() pompásan használható más karakterre is, nem csupán white space-ekre
        // a trim(), ltrim(), rtrim() függvények default értéke a space-ek eltávolítása a szövegből
        // paraméterezve bármilyen karakter eltávolítható a stringből
        // mivel itt kezdő karakterekről volt szó, az ltrim()-et használtuk
        $nullakEltavolitasa = ltrim($adat, '0');
        echo $nullakEltavolitasa;
        ?>
    </body>
</html>
