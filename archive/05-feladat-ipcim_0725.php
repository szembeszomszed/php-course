<!DOCTYPE html>
<!--
5) Írjunk egy PHP szkriptet ami visszaadja a kliens IP címét
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Kliens IP-cím visszaadása</h2>
        <?php
        // az IP cím visszaadással lehet pl letiltani országokat, látogatókat
        // http://php.net/reserved.variables.server
        
        //ha az IP cím egy megosztott hálózatról jön
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_cim = $_SERVER['HTTP_CLIENT_IP'];
            
        //ha az IP cím proxyról jön
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_cim = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
        //ha az IP cím távoli kiszolgálóról jön
        } else {
            $ip_cim = $_SERVER['REMOTE_ADDR'];
        }
        
        // anonim IP címekre is lehet egyébként szűrni - hasznos a rossz szándékú csávók ellen
        
        echo '<pre>';
        echo $ip_cim;
        echo '</pre>';
        
        ?>
    </body>
</html>
