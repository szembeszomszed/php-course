<!DOCTYPE html>
<!--
10)  Írjunk egy PHP szkriptet, ami visszaadja hogy az oldal http -t vagy https-t használ
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // SSL - megbízhatósági tanúsítvány
        // zöld lakat csak akkor jelenik meg, ha a belső linkek mind https:// oldalról jönnek
        // http:// oldalról jövő tartalom (pl linkelt kép) esetén felkiáltójel is megjelenik ám
        
        if(!empty($_SERVER['HTTPS'])) {
            echo 'HTTPS-t használ az oldal'; 
        } else {
            echo 'HTTP működik';
        }
        ?>
    </body>
</html>
