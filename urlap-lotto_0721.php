<?php

$limit = 90;
$huzasokSzama = 5;

if (filter_input(INPUT_POST, 'submit')) {
    //hibakezelés
    $hiba = []; // vagy ugye $hiba = array();
    
    $tippek = filter_input(INPUT_POST, 'adat', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    // a mezők értékeinek változóba mentésekor meg kell tisztítani az inputot esetleges kártékony kódoktól
    // ehhez jó a FILTER_SANITIZE_STRING
    // a FILTER_REQUIRE_ARRAY azért kell, hogy tömbértéket várjon inputként
    // tehát a tippes mezőbe beírt adatot olvassuk itt be
    
    //var_dump($tippek);
    
    // egyéni szűrő a bevitt adatokra - tömbök tömbje
    $filterOpciok = array(
        'options' => array (
            'min_range' => 1,
            'max_range' => $limit,
        ),
    );
    
    //Hasznos! A szűrés és a szűrők beállításának forrása: 
    // http://php.net/manual/en/function.filter-input.php
    
      
    //var_dump($filterOpciok);
    
    //a szűrés ciklusban fog megtörténni, ahogyan bejárjuk a tömböt minden elemre
    
    
    $egyediTippek = array_unique($tippek); // ezek az egyedi tippek - ha ismétlés volt, akkor azok hiányoznak
    
    //kulcs és érték alapján bejárjuk a $tippek tömböt
    //a ciklusban kezeljük le az egyes adatokat
    //erre szintén rászűrünk - 
        //első paraméter maga a tipp
        //második paraméter megvizsgálja, hogy integer-e - ha nem mentődik el az adat
        //harmadik paraméter valahogy megnézi, hogy az érték belül van-e a kívánt tartományon
    
    foreach ($tippek as $mezo => $tipp) { //bejáróciklus - a tömbök bejárására használjuk
        $adat = filter_var($tipp, FILTER_VALIDATE_INT, $filterOpciok); //filter_input helyett itt filter_var kell, hiszen egy váltózóból szedem ki az adatot - megspékelve az egész számokra szűrő FILTER_VALIDATE_INT-tel
        // a $filterOpciok pedig azért kell paraméternek, hogy így meg tudjuk adni a limiteket is
        
        if ($adat == FALSE) {
            
        //$hiba['adat']; // így nem tudnánk, hogy melyik mezőben történt a hiba
        //de mivel a második dimenzió maga a mező száma (a bejáró ciklus kulcsa), ezért ha itt jelezzük, hogy tömbök tömjéről van szó
            
            $hiba['adat'][$mezo] = '<span style="color: red;">Nem értelmezhető adat</span>'; // tömbök tömbjébe kerül így már
        }
        
        // meg kell nézni, hogy ez egyediTippekben benne van-e a kulcsérték - ha nincs, jön a hibaüzenet
        if (!array_key_exists($mezo, $egyediTippek)) {
            $hiba['adat'][$mezo] = '<span style="color: red;">Ezt már tippelted</span>';
        }
       
        
    } 
    
}

?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>
            
            <form method="post">
                <?php
                for ($i = 1; $i <= $huzasokSzama; $i++) {
                    echo '<br/><label for="adat'.$i.'">Adat - '.$i. '. húzás</label>'
                        .'<input type="text" name="adat['.$i.']" id="adat['.$i.']"' // figyelni kell, hogy a majdani mezők attribútumai különbözők legyenek (legalábbis ahol ez előírás, pl id) - ebben segít a ciklusváltozó
                            //multidimenziós array-t használunk majd, ezért van ez a formátum: adat[$i]
                        .'placeholder="12" value="'.$tippek[$i].'" maxlength="2" size="3"/>'
                        .$hiba['adat'][$i];
                }
                
                ?>
                
                
                
                <br/>
                <input type="submit" name="submit" value="Mehet"/>
            </form>
            
        </div>
    </body>
</html>
