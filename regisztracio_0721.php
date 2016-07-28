<?php
$output = ''; // már itt definiáljuk, elkerülendő a hibaüzenetet az oldalra érkezéskor
if (filter_input(INPUT_POST, 'submit')) {
    $hiba = []; // üres hibatömb létrehozása hibáknak
    //szöveg eleji-végi szóközök eltávolítása -> ltrim(), rtrim(), trim()
    $nev = trim(filter_input(INPUT_POST, 'nev'));
    //string hossza -> strlen(string), csak a strlen nem az utf-8-as kódlapot használja/
    //ezért -> mb_strlen(string, encoding)
    if(mb_strlen($nev, 'utf-8') < 3) { 
        $hiba['nev'] = '<h4 style="color: red;">A név minimum 3 karakter hosszú legyen</h4>'; //tehát hiba esetén a hibatömb név kulcsára beteszünk egy szöveget
    }
    
    //email ellenőrzése a FILTER_VALIDATE_EMAIL szűrővel működik - de ez csak a FORMÁJÁT ellenőrzi!
    //kívülről nehéz leellenőrizni a valódiságot, mert az email-szolgáltatók bannolják az ip-t ilyen scannelő tevékenységek esetén
    //ezért kell majd a megerősítő email
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if(!$email) {
        $hiba['email'] = '<h4 style="color: red;">Nem értelmezhető adat</h4>'; //email-kulcsra kerül a hibaüzenet
    }
    
    //jelszókezelés
    $pass = filter_input(INPUT_POST, 'pass');
    $repass = filter_input(INPUT_POST, 'repass');
    if(mb_strlen($pass, 'utf-8') < 6 OR mb_strlen($pass, 'utf-8') > 12) {
        $hiba['pass'] = '<h4 style="color: red;">Nem megfelelő jelszóhosszúság</h4>';
    } elseif ($pass != $repass) {
        $hiba['repass'] = '<h4 style="color: red;">Nem egyező jelszavak</h4>';
    } else {
        //a jelszavakat mindig titkosítva tároljuk shal vagy md5 titkosító algoritmussal
        //hogy növeljük a biztonságot, egy titkosító tokent készítünk, amit hozzáfűzünk
        $secret_key = "!53cr3t_K3y!"; // bármilyen nehezen kitalálható string megadható (lehet generáltatni is ilyet)
        $pass = md5($pass.$secret_key); //a jelszó lekódolása a titkosító token hozzáfűzésével - ez így visszafejthetetlen       
    }
    
    //felhasználói feltételek
    if (!filter_input(INPUT_POST, 'terms')) { //azt nézzük, hogy ha nincs bepipálva
        $hiba['terms'] = '<h4 style="color: red;">A feltételeket kötelező elfogadni!</h4>';       
    }
    
    
    if(empty($hiba)) { //ha a hibatömb üres, akkor megkezdődhet a feldolgozás
        //állítsunk össze egy adatlapot a kapott adatokkal
        //egy változóba stringként elmentjünk a táblázatot, és majd ezt echozzuk ki
        
        //én megoldásom:
        
        $dataReceived = '             
                <table border="1" style=\"border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Email</th>
                            <th>Jelszó</th>
                            <th>Dátum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$nev.'</td>
                            <td>'.$email.'</td>
                            <td>'.$pass.'</td>
                            <td>'.date('D, d M Y H:i:s').'</td>
                        </tr>
                    </tbody>
               </table>
             ';       
        
        //echo $dataReceived;
        
        // másik megoldás:
        // soronként konkatenáljuk a változóhoz a táblázat elemeit
        
        $output = '<table border="1" style="border-collapse: collapse">';
        $output .= '<tr>'
                .'<th>Név</th>'
                .'<th>Email</th>'
                .'<th>Jelszó</th>'
                .'<th>Dátum</th>'
                .'</tr>'
                .'<td>'.$nev.'</td>'
                .'<td>'.$email.'</td>'
                .'<td>'.$pass.'</td>'
                .'<td>'.date("Y-m-d H:i:s").'</td>'
                .'</tr>';
        $output .= '</table>';       
        
    }
}
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Regisztrációs űrlap</title>
        <style>
            h4 {display: inline;} /* így kerül a mező mellé a majdani hibaüzenet */
        </style>
    </head>
    <body>
        <?php
        
        if ($output != '') {
            echo $output;
            exit(); // mindent megszakít, így az ezt követő sorok nem fognak lefutni, és csak a táblázat marad az oldalon
        }
        
        ?>
        <form method="post">
            <fieldset>
                <legend>Regisztrációs űrlap</legend>
                <!--név-->
                <label for="name">Név (min. 3 karakter)</label>
                <input type="text" name="nev" id="nev" placeholder="Írja ide a nevét" <?php echo (empty($hiba['nev']) ? 'style="color: green;"' : 'style="color: red;"'); // a visszaírás színét aszerint állítjuk zöldre vagy pirosra, hogy helyes volt-e a beírt adat ?> value="<?php echo filter_input(INPUT_POST, 'nev');?>"/>
                <?php echo (empty($hiba['nev']) ? "" : $hiba['nev']); // ha a hibatömb kulcsa nem üres, echozunk?>
                <!--email-->
                <br/>
                <label for="email">Email cím</label>
                <input type="text" name="email" id="email" placeholder="minta@email.hu" <?php echo (empty($hiba['email']) ? 'style="color: green;"' : 'style="color: red;"'); // a visszaírás színét aszerint állítjuk zöldre vagy pirosra, hogy helyes volt-e a beírt adat ?> value="<?php echo filter_input(INPUT_POST, 'email');?>"/>
                <?php echo (empty($hiba['email']) ? "" : $hiba['email']); // ha a hibatömb kulcsa nem üres, echozunk?>
                <!--jelszó-->
                <br/>
                <label for="pass">Jelszó (6-12 karakter)</label>
                <input type="password" name="pass" id="pass"/>
                <?php echo (empty($hiba['pass']) ? "" : $hiba['pass']); // ha a hibatömb kulcsa nem üres, echozunk?>
                
                <!--jelszó újra-->
                <br/>
                <label for="repass">Jelszó újra</label>
                <input type="password" name="repass" id="repass"/>
                <?php echo (empty($hiba['repass']) ? "" : $hiba['repass']); // ha a hibatömb kulcsa nem üres, echozunk?>
                
                <!-- feltételek -->
                <br/>
                <!-- ha már becsekkoltuk, gombnyomás után becsekkolva marad a checkbox - az attribútumot és a value-t íratjuk be a tagbe short if-fel, megnézzük nem csak azt, hogy a terms kulcs megjelenik-e a szuperglobális tömbben, hanem azt is, hogy az érték 1-e -->
                <input type="checkbox" name="terms" id="terms" value="1" <?php echo filter_input(INPUT_POST, 'terms') == '1' ? 'checked="checked"' : "";?>/>
                <!-- a target="_blank" új lapon nyitja meg a linket-->
                <label for="terms">Elfogadom a <a href="#" target="_blank">regisztrációs feltételeket</a>.</label>
                <?php echo (empty($hiba['terms']) ? "" : $hiba['terms']); // ha a hibatömb kulcsa nem üres, echozunk?>
            </fieldset> 
            <input type="submit" name="submit" value="Regisztráció"/>
        </form>
    </body>
</html>
