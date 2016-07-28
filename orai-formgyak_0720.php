<?php

if(filter_input(INPUT_GET, 'submit')) {
    $hiba = []; // üres hibatömb deklarálása
    $szam = filter_input(INPUT_GET, 'szam', FILTER_VALIDATE_INT); // a 3. paraméterként beállított szűrő csak integer-t enged be a $szam-ba

    //tehát a 'szam' mező értékét letisztázva tároltuk el a $szam változóban, így csak egész szám kerülhet bele
    
    if ($szam < 1) {
        $hiba['szam'] = '<span class="error">HIBA! Az adat nem értelmezhető</span>';
        
        //ha hibát kezelünk, az egyszerűség kedvéért egy hibatömbben tárolom el az összes hibát,
        //ahol az asszociatív kulcsok az adott mezőhöz tartozó név
        //A SUBMIT GOMB MEGNYOMÁSAKOR MINDEN ÚJRAINDUL
    }
    
    if(empty($hiba)) {
        $output = '';
        //Írjuk ki beírt számszor az 'OK' betűket
        for ($i = 0; $i <= $szam; $i++) {
            $output .= 'OK'; // FONTOS! értékadás '=' operátor helyett a konkatenációt kell használni, hogy ne írjuk felül
            // az eredményt, azaz '.=' operátort használunk
            // sima echo-val is működne amúgy
        }        
        $output .= '<br/>';
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Űrlap feldolgozása</title>
    </head>
    <body>
        <form> <!-- nem definiált method esetén GET a default -->
            <fieldset>
                <legend>Feldolgozás</legend>
                <label for="szam">Kérek egy pozitív egész számot</label>
                <input type="text" name="szam" value="<?php echo filter_input(INPUT_GET, 'szam'); // ÉRTÉK VISSZAÍRÁSA A SZÁM MEZŐBE, SUBMIT GOMB MEGNYOMÁSÁT KÖVETŐEN ?>" placeholder="123"/>
                <?php 
                //array_filter($hiba);
                //if(!empty($hiba)) {
                echo  (!empty($hiba) ? $hiba['szam'] : ''); // SHORT IF-ES SZERKEZETTEL VIZSGÁLOM, HOGY ÜRES-E A $HIBA
                // HA NEM ÜRES, AKKOR KIÍRATOM A VÁLTOZÓ ÉRTÉKÉT?>
            </fieldset>
            <input type="submit" name="submit" value="Elküld"/>
        </form>
        <?php echo (!empty($output) ? $output : ''); // SHORT IF-ES SZERKEZETTEL VIZSGÁLOM, HOGY ÜRES-E AZ $OUTPUT
        // HA NEM ÜRES, AKKOR KIÍRATOM A VÁLTOZÓ ÉRTÉKÉT?> 
    </body>
</html>


