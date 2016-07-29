<?php
/*
 * 3) Hozzunk létre egy $var = 'PHP Tanulás' változót, és írjuk h3 tagként a szöveg elé, és a szöveg végére linket + oldalcímként:

  PHP Tanulás
  A Webprogramozó nem dizájnol, hanem cselekszik! Az informatikai szakma krémjének számító programozói ágazat képviselője
  lehetsz, ha részt veszel kurzusunkon! Ideje, hogy a HTML után, CSS, PHP, MYSQL, és Apache kifejezések is értelmet
  kapjanak az életedben, mert ha Webes programozói képzésünket választod, akkor bátran jelentheted majd ki oktatóinknak
  köszönhetően, én már tudom mi a siker kulcsa! Lépd át a határt és foglald el helyedet a professzionális
  szakprogramozók között egy folyamatosan fejlődő kreatív szakmában!
  Kattints a PHP tanulás linkre
 */
$var = 'PHP Tanulás';
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $var; ?></title>
    </head>
    <body>
        <?php
        echo "<h3><a href=\"#\">$var</a></h3>";
        echo "<p>A Webprogramozó nem dizájnol, hanem cselekszik! Az informatikai szakma krémjének számító programozói ágazat képviselője 
       lehetsz, ha részt veszel kurzusunkon! Ideje, hogy a HTML után, CSS, PHP, MYSQL, és Apache kifejezések is értelmet 
       kapjanak az életedben, mert ha Webes programozói képzésünket választod, akkor bátran jelentheted majd ki oktatóinknak 
       köszönhetően, én már tudom mi a siker kulcsa! Lépd át a határt és foglald el helyedet a professzionális 
       szakprogramozók között egy folyamatosan fejlődő kreatív szakmában!
       Kattints a <a href=\"#\">$var</a> linkre</p>";
        ?>
    </body>
</html>
