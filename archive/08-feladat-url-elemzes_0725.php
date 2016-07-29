<!DOCTYPE html>
<!--
8) Írjunk egy PHP szkriptet ami kielemzi a http://www.w3schools.com/html/html_images.asp címet
	Output: Séma : http
                Host : www.w3schools.com
                Útvonal : /html/html_images.asp
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $url = 'http://www.w3schools.com/html/html_images.asp';
        
        $url = parse_url($url); // parse_url-rel linkként kezeljük a stringet
        echo 'Séma: '.$url['scheme'].'<br/>';
        echo 'Host: '.$url['host'].'<br/>';
        echo 'Útvonal: '.$url['path'].'<br/>';
        echo '<pre>';
        var_dump($url);
        echo '</pre>';
        ?>
    </body>
</html>
