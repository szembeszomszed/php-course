<?php
var_dump($_GET, $_POST, $_REQUEST); // a _REQUEST szuperglobális tömb a POST és a GET uniója, 
// névegyezés esetén a POST mindig erősebb, mint a GET
// tehát ha REQUEST-et használunk, abban benne lesz mindkét másik
// serverirányban műveletet POST-tal
// űrlapoknál GET-et használunk
// a paraméterezett URL is a GET-be kerül
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Űrlapelemek gyakorlása</title>
        
        <!-- aranyos szövegszerkesztő felület a tinymce.com-ról-->
        
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
    </head>
    <body>
        <form method="post">
            <label for="nev">Név </label>
            <input type="text" name="nev" placeholder="Írd be a neved!" value="<?php echo filter_input(INPUT_POST, 'nev');?>"/>
            <hr/>
            <select name="gender">
                <option value="0">----Választás----</option>
                <option value="1">Férfi</option>
                <option value="2">Nő</option>
            </select>
            
            <!-- ha a select mezőből ki lett választva a férfi/nő, akkor írjuk ki, hogy férfi/nő kiválasztva-->
            <?php echo (filter_input(INPUT_POST, 'gender') == 1 ? "Férfi kiválasztva" : ''); ?>
            <?php echo (filter_input(INPUT_POST, 'gender') == 2 ? "Nő kiválasztva" : ''); ?>
            <?php            
            //az én kevésbé szép megoldásom:
            /*
            if (filter_input(INPUT_POST, 'gender') == 1) {
                echo "Férfi kiválasztva";
            } elseif (filter_input(INPUT_POST, 'gender') == 2) {
                echo "Nő kiválasztva";
            }
            */
            ?> 
            <br/>
            <label for="hirlevel">Hírlevél</label>
            <input type="checkbox" name="hirlevel" id="hirlevel" value="1"/>
            <!-- írjuk ki, hogy kér-e hírlevelet -->
            <?php echo (filter_input(INPUT_POST, 'hirlevel') == 1 ? 'Hírlevél beállítva' : '');?> 
            <hr/>
            <h4>Előfizetői szolgáltatások</h4>
            <?php
            $tombokTombje = array(
                'service' => array(
                    'flags' => FILTER_REQUIRE_ARRAY // A SZŰRŐ AZÉRT KELL, HOGY BIZTOSAN TÖMB KERÜLJÖN ERRE A KULCSRA
                ), // KELL A VESSZŐ A LEZÁRÁS ELŐTT
            );
            
            $szolgaltatasok = filter_input_array(INPUT_POST, $tombokTombje); //gombnyomáskor a szolgáltatásokba kerülnek a
            //multidimenziós tömb elemei
            //filter_input_array-t használunk, mert a sima filter_input egy stringet vár második paraméternek
            var_dump($szolgaltatasok);
            echo '<br/>';
            
            echo ($szolgaltatasok['service']['hosting'] == 1) ? "Tárhelyszolgáltatást kérek" : ""; // kiírás 2. dimenzióról
            //short if-fel megspékelve
            ?>
            <br/>
            <br/>
            <input type ="checkbox" id ="hosting" value="1" name="service[hosting]"/>
            <label for="hosting">Tárhely</label>
            <input type="checkbox" id="domain" value="1" name="service[domain]"/>
            <label for="domain">Domain</label>
            <input type="checkbox" id="cms" value="1" name="service[cms]"/>
            <label for="cms">Tartalomkezelők</label>   
            <br/>
            <br/>            
            <input type="radio" name="fizetesi_gyakorisag" value="havi" id="havi"/>
            <label for="havi">Havi</label>
            <input type="radio" name="fizetesi_gyakorisag" value="Éves" id="eves"/>
            <label for="eves">Éves</label>
            <input type="radio" name="fizetesi_gyakorisag" value="Negyed" id="negyed"/>
            <label for="negyed">Negyedéves</label>
            <br/>
            <br/>            
            <select name="internet">
                <option value="0">----Internetcsomagok----</option>
                <option value="1">Alap</option>
                <option value="2">Közép</option>
                <option value="3">Csúcssebesség</option>
            </select>
            <br/>
            <br/>            
            <label for="lead">Bevezető szöveg</label>
            <textarea name="lead" cols="70" rows="30" >
                <?php echo filter_input(INPUT_POST, 'lead');?>
            </textarea>
            
            <br/>
            <br/>
            <input type="submit" name="submit" value="Elküld"/>
        </form>
    </body>
</html>
