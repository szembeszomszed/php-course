<?php

// munkamenetet indítunk, hogy a kosár tartalmát akkor is megőrizzük majd, ha esetleg kilép a user
session_start();

// hibakijelzés (csak fejlesztési szakaszban)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// adatbáziskapcsolat
require 'boltszkriptek/kapcsolat_a_mysqlhez.php';
?>

<?php

// 1) ha a termékek-oldalról tesznek be a kosárba egy terméket

if (isset($_POST['pid'])) {
    $pid = mysql_real_escape_string($_POST['pid']);
    
    // alapesetben false-ra állítjuk ezt a változót, melyet majd a megfelelő szcenárióban true-ra rakunk
    // és erre majd vizsgálni is fogunk
    $megtalaltam = false;
    
    // ezt itt meg alapesetben nullára állítjuk
    $i = 0;
    
    // megnézzük, be van-e állítva a sessionünk kosárkulcsa (ami majd tömbök tömbje lesz egyébként)
    // illetve or vizsgálattal megnézzük, hogy a tömbnek kevesebb eleme van-e, mint 1
    // ha ez itt teljesül, vagy nem is létezik, vagy nincs benne érték
    if (!isset($_SESSION['kosar_tomb']) || count($_SESSION['kosar_tomb']) < 1) {
        
        // ha a kosár üres, teszünk bele értéket - feltöltjük a kosarat, vagyis a kosártömböt
        // tehát a kosártömb nulladik kulcsára bepakoljuk a termék id-ját és a darabszámot (by default 1-re állítjuk)
        // tehát ha a kosárba gombra kattint a user, a darabszám beáll 1-re
        $_SESSION['kosar_tomb'] = array(0 => array("item_id" => $pid, "darabszam" => 1));
        
    } else {
        
        // ha a kosárban már legalább egy termék van
        // bejárjuk szépen a SESSION kosártömbjét, sima 'értékes' foreachcsel
        // így megnézzük, hány darab termék van benne
        
        foreach ($_SESSION['kosar_tomb'] as $minden_elem) {
            // a fent létrehozott $i értékét növeljük
            $i++;
            
            // ciklussal bepakoljuk az elemeket a tömbbe
            // mivel nem tudjuk, hány elem van benne, ezt a módszert alkalmazzuk
            // addig kell menni az elemeken, amíg meg nem találjuk az egyező elemeket
            
            // a list() külön tömbökbe-változókba rakja a tömb elemeit
            // az each() lépteti aranyosan az elemeket
            // az összes kulcsot és értéket ki kell gyűjtenem a tömbből
            // ezekbe a változókba minden értéket el kell tárolnom
            while (list($key, $value) = each($minden_elem)) {
                // ez minden ciklusfutáskor újraíródik
                // ezért kell a cikluson belülre rakni az if-et
                // így minden egyes futáskor rávizsgálunk az értékekre
                
            
           
                
                
                if ($key == 'item_id' && $value == $pid) {
                // ha megtaláltuk az egyező elemeket azaz a kulcs és érték egyenlő, akkor:
                // ebben az esetben elegendő a darabszámot módosítani
                // (tehát itt arról van szó, hogy olyan terméket dobnak a kosárba, amiből már van benne)
                // a tömb elemének a lecserélésére szolgál az array_splice() függvény 
                // tehát minden ciklusfutáskor elvégezzük a vizsgálatot, és
                   // mivel az $i már 1-gyel növelt, ezért csökkentenünk kell 1-gyel
                    // a 4. paraméter az, hogy mire cserélünk
                    // ott is szépen az elem darabszámát 1-gyel növelt értékre változtatunk
                    array_splice($_SESSION['kosar_tomb'], $i - 1, 1, array(array("item_id" => $pid, "darabszam" => $minden_elem['darabszam'] + 1)));
                    $megtalaltam = true;
                    // ha ez true, itt nincs több teendő, mert megnöveltük a termék darabszámát
                    
                } // if vége
            } // while vége   
            
        } // foreach vége
        
        // ellenkező esetben beteszem a kosárba a terméket
        // persze attól, hogy az adott termék még nincs a kosárban, még lehet benne más termék
        // ezért a tömb legvégére fogjuk pakolni az új elemeket
        if ($megtalaltam == false) {
            
            // ha a megtaláltam hamis maradt, akkor tehát nem talált egyező terméket
            // azaz egy új terméket veszek fel
            // FONTOS! ez nem azt jelenti, hogy a kosártömb üres, azaz lehet benne akárhány darab termék
            // így a végére célszerű helyezni az új tételeket
            // ezt az array_push() segítségével fogunk megtenni
            // első paraméter: hova, második paraméter: mit pakolok bele
            // ezért másodiknak a tömbben lévő tömböt adjuk meg neki
            // ő majd szépen ezután rakja be a cuccokat
            array_push($_SESSION['kosar_tomb'], array("item_id" => $pid, "darabszam" => 1));
        }
    }
    // oldal frissítése, vagyis átirányítás
    
    header('Location: kosar.php');
    exit();
}
?>

<?php

// 2) ha a felhasználó ki szeretné üríteni a kosarát

if (isset($_GET['kosar']) && $_GET['kosar'] == 'kosartorol') {
    unset($_SESSION['kosar_tomb']);
}

?>


<?php

// 3) ha a felhasználó módosítani szeretné a darabszámot

if (isset($_POST['elem_a_noveleshez']) && $_POST['elem_a_noveleshez'] != "") {
    $elem_a_noveleshez = $_POST['elem_a_noveleshez'];
    $darabszam = $_POST['darabszam'];
    // kis tisztítás sem árt
    $darabszam = preg_replace("#[^0-9]#i", '', $darabszam);
    
    // a felhasználói hibák miatt a darabszámot maximalizáljuk és ellenőrizzük
    // ha irreális értékek érkeznek, adunk helyettük reálisat
    if ($darabszam >= 100) { $darabszam = 99; }
    if ($darabszam <= 1) { $darabszam = 1; }
    if ($darabszam == "") { $darabszam = 1; }
    
    // deklarálunk egy változót, egyelőre nullára
    $i = 0;
    
    foreach ($_SESSION['kosar_tomb'] as $minden_elem) {
        
            $i++;
        while (list($key, $value) = each($minden_elem)) {        

            if ($key == 'item_id' && $value == $elem_a_noveleshez) {

                array_splice($_SESSION['kosar_tomb'], $i - 1, 1, array(array("item_id" => $pid, "darabszam" => $darabszam)));
                // itt tehát a user egy konkrét darabszámot állított be, ezt alkalmazzuk a fentiekhez hasonló módon
                // akkor, amikor átállítjuk a termék darabszámát
                // a user által beállított darabszámot a POST-ból vesszük át
            } 
        } 
    } 
}
?>

<?php

// 4) ha csak 1 terméket törölne a user

if (isset($_POST['index_a_torleshez']) && $_POST['index_a_torleshez'] != "") {
    
    $kulcs_a_torleshez = $_POST['index_a_torleshez'];
    
    // a tömbből ki kell szednünk a megfelelő kulcsú elemet
    // megnézzük, hány elem van a kosártömbben
    // ha csak max 1 termék van benne, töröljük a kulcsot
    if (count($_SESSION['kosar_tomb']) <= 1) {
        unset($_SESSION['kosar_tomb']);
    } else {
        // ha több elem van benne, csak a megfelelő termék kulcsát töröljük
        unset($_SESSION['kosar_tomb']["$kulcs_a_torleshez"]);
        
        // újraindexeljük a tömböt, mert esélyes, hogy összekavarodott
        sort($_SESSION['kosar_tomb']);
    }
}
?>

<?php

// 5) a kosár látható elemeinek összekészítése
$outputKosar = "";
$osszesenKosar = "";
$termek_id_tomb = "";
$pp_fizetes_gomb = "";

// nézzük meg, hogy a kosár üres-e - ha igen, akkor üzenet kiíratása következik
if (!isset($_SESSION['kosar_tomb']) || count($_SESSION['kosar_tomb']) < 1) {
    $outputKosar = '<h2 align="center">Az ön kosara üres</h2>';
} else {
    // paypal fizetésgomb elkészítése élesben ezen a linken keresztül fog menni (a webscr után kell majd beékelni egy a paypal developertől kapott kódsorozatot: https://paypal.com/cgi-bin/webscr)
    $pp_fizetes_gomb .= '<form action="https://paypal.com/cgi-bin/webscr" method="post">'
            . '<input type="hidden" name="cmd" value="_cart(azonosito)"/>' // cmd->command
            . '<input type="hidden" name="upload" value="1"/>' // value=1 itt azt jelenti, hogy mehet a vásárlás
            . '<input type="hidden" name="business" value="business@email.cim"/>'; // milyen típusú fiókunk van
    
    // tömbbejáró ciklus készítése
    $i = 0;
    
    foreach($_SESSION['kosar_tomb'] as $minden_elem) {
        $item_id = $minden_elem['item_id'];
        
        // írunk egy lekérdezést, hogy kiderüljön, megvan-e még az adott termék az adatbázisban
        // ez nagyon FONTOS, mivel fizetés történik!
        $sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
        $row = mysql_fetch_array($sql);
        $product_name = $row['product_name'];
        $price = $row['price'];
        $details = $row['details'];
        
        // kiszámítjuk a total price-t
        $osszesenAr = $price * $minden_elem['darabszam'];
        $osszesenKosar += $osszesenAr;
        
        // a területi beállításokat meg kell adni
        setlocale(LC_MONETARY, 'hu-HU');
        
        // és még meg kell adni a pénznemformátumot is
        // a formátumhoz érdemes megnézni a php-súgót
        // FONTOS! a money_format windows alatt nem működik :)
        // (ha nem írja ki, hogy money_format not found, akkor működik)
        // ezért egy általa hiányolt eljárást kell készíteni, amit később törölni kell
        // és azért kell törölni, mert különben később a szerveren linux alatt nem működne a dolog
        $osszesenAr = money_format("%10.2n", $osszesenAr);
        
        // folytatjuk a paypal-gomb összekészítését
        // a pp számára a termékeket dinamikusan kell kezelni
        // ezért egy változót felveszünk, amit majd hozzáfűzünk az alant lévő elemekhez
        $x = $i + 1;
        $pp_fizetes_gomb .= '<input type="hidden" name=item_name_'.$x.'" value="'.$product_name.'"/>'
                . '<input_type="hidden" name="amount_'.$x.'" value="'.$price.'"/>'
                . '<input_type="hidden" name="quantity_'.$x.'" value="'.$minden_elem['darabszam'].'"/>';
        
        // a terméktömb változójának elkészítése
        $termek_id_tomb = "$item_id - ".$minden_elem['darabszam'].", ";
        
        // a táblázatom elkészítése (csak sorok lesznek benne)
        $outputKosar .= "<tr>";
        $outputKosar .= "<td>$product_name<br/><img src='./termekkepek/$item_id.jpg' alt='product_name' width='40' height='50'/></td>";
        $outputKosar .= "<td>$details</td>";
        $outputKosar .= "<td>$price Ft</td>";
        
        // darabszám módosítása és megjelenítése
        
        $outputKosar .= '<td><form method="post" action="kosar.php">'
                . '<input name="darabszam" type="text" value="'.$minden_elem['darabszam'].'" size="1" maxlength="2"/>'
                . '<input name="modositgomb" type="submit" value="Változtat"/>'
                . '<input type="hidden" name="elem_a_noveleshez" value="'.$item_id.'"/>'
                . '</form></td>';
        
        // így a darabszámot látjuk, de nem tudjuk módosítani - persze ez egyszerűbb volna
        // $outputKosar .= '<td>'.$minden_elem['darabszam'].'</td>';
        
        // törlés gomb művelet elkészítése
        // annak érdekében, hogy ne legyen minden törlés gomb neve azonos, hozzáfűzzük mindegyikhez az item_id-t
        $outputKosar .= '<td><form method="post" action="kosar.php">'
                . '<input name="torolGomb'.$item_id.'" type="submit" value="Töröl"/>'
                . '<input name="index_a_torleshez" type="hidden" value="'.$i.'"/></form></td>';
        $outputKosar .= '</tr>';
        
        // növelni kell az $i értékét is ciklusfutásonként
        $i++;                
        
    } // foreach vége
    
    setlocale(LC_MONETARY, 'hu_HU');
    $osszesenKosar = money_format("%10.2n", $osszesenKosar);
    
    // megírjuk az eljárást, amit elvileg hiányol (bár most nem)
    // ezt majd törölni kell linux-szerveren
    function money_format($format, $num) {
        return number_format($num, 2);
    }
}

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Kosár</title>
    </head>
    <body>
        <div align="center">
            <?php include './fejlec_sablon.php'; ?>
            <div id="pageContent">
                <div style="text-align: left">
                    <table width="100%" cellspacing="0">
                        <tr>
                            <td><strong>Termék</strong></td>
                            <td><strong>Leírás</strong></td>
                            <td><strong>Ár</strong></td>
                            <td><strong>Darab</strong></td>
                            <td><strong>Összesen</strong></td>
                            <td><strong>Eltávolítás</strong></td> 
                        </tr>
                        <?php echo $outputKosar; ?>
                    </table>
                    <?php echo $osszesenKosar; ?>
                    <br/>
                    <br/>
                    <?php echo $pp_fizetes_gomb; ?>
                    <br/>
                    <br/>
                    <a href="kosar.php?kosar=kosartorol">Kosár teljes törlése</a>
                </div>
            </div>
            <?php include './lablec_sablon.php'; ?>
        </div>
    </body>
</html>
