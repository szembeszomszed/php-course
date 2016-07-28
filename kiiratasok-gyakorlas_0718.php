<?php

header("Content-type:text/html; charset=utf-8"); 
//natúr php file-ban ilyen módon jeleníthetjük meg a headert
// charset -> karakterkódolás

$nev = "Karcsi";
$email = "teszt@teszt.hu";

//változók kiíratása html-tagekkel

echo "<div>Üdvözöllek, Kedves <strong>$nev</strong> a honlapon!";
//ugyanez aposztróffal
//echo '<div>Üdvözöllek, Kedves <strong>'.$nev.'</strong> a honlapon!';
// ''-ok között változóértéket nem tudunk kiíratni, ezért kell a . operátor

//az összes html taget használhatjuk

echo '<section class="wrapper">'; //tag nyitása - css-ben erre ugyanúgy lehet majd hivatkozni
echo '<h2>Adott egy háromszög 2 befogója, számítsuk ki az átfogót(derékszög)</h2>';
// az oldalszerkezet kialakítása is  egyszerű php fájl alól is a tanult
// módon működik, csak figyeljünk a szöveghatárolókra ('' "")

echo '<div class="megoldas">'; //megoldás nyitótag
$a = 3;
$b = 4;
$c = sqrt(pow($a, 2) + pow($b, 2)); 
// sqrt(number) -> négyzetgyök
// pow(alap, kitevő) -> hatványozás

echo "Az (a) befogó: $a, a (b) befogó: $b és az átfogó: $c";
//'' között a kiíratás konkatenációval lehetséges:
echo "<br/>";
echo 'Az (a) befogó: '.$a. ', a (b) befogó: '.$b. ' és az átfogó: '.$c;
// a konkatenáció egyébként ugyanúgy működik ""-jel, mint ''-fal
echo "</div>";
echo "</section>;"

//önálló php fájlban egyébként nem szükséges a zárótag - de persze nem is árt
?> 






