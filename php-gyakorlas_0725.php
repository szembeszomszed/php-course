<?php

/*
 * 1) Írjunk egy PHP szkriptet, ami visszaadja a szerver php információit
 */
echo phpinfo();

/*
2) Írjunk egy PHP szkriptet ami visszaadja a következő Szöveget:
   Értem a PHP-t.
   Törlök mindent a gépről: del c:\*.*
 * 
 */

echo "Értem a PHP-t. <br/> Törlök mindent a gépről: del c:\*.* <br/>";

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

echo '<title>'.$var.'</title>';
echo '<h3><a href="'.$var.'">PHP Tanulás</a></h3>';
echo '<p>A Webprogramozó nem dizájnol, hanem cselekszik! Az informatikai szakma krémjének számító programozói ágazat képviselője 
       lehetsz, ha részt veszel kurzusunkon! Ideje, hogy a HTML után, CSS, PHP, MYSQL, és Apache kifejezések is értelmet 
       kapjanak az életedben, mert ha Webes programozói képzésünket választod, akkor bátran jelentheted majd ki oktatóinknak 
       köszönhetően, én már tudom mi a siker kulcsa! Lépd át a határt és foglald el helyedet a professzionális 
       szakprogramozók között egy folyamatosan fejlődő kreatív szakmában!
       Kattints a <a href="'.$var.'">PHP tanulás</a> linkre</p>';

/*
 * 4) Írjunk egy HTML formot egy darab text mezővel, ami gombnyomásra kiirja a text mező tartalmát (a mező alá)
 */

?>
 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="post">
            <input type="text" name="szoveg" placeholder="írj ide valamit!" value="<?php echo filter_input(INPUT_POST, 'szoveg') ?>">
            <input type="submit" name="submit" value="rajta!">
        </form>
    </body>       
</html>
<?php
if (filter_input(INPUT_POST, 'submit')) {
    $szoveg = filter_input(INPUT_POST, 'szoveg', FILTER_SANITIZE_STRING);
    echo $szoveg;
}
?>