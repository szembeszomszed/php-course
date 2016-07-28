<?php

$limit = 100;
$output = '';

if (filter_input(INPUT_POST, 'submit')) {
    $hiba = [];

    /* ez legalább működik
    $szolo = filter_input(INPUT_POST, 'szolo');
    var_dump($szolo);
    */

    $fruits = filter_input(INPUT_POST, 'fruits', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

    //var_dump($fruits);

    $egyeniSzuro = array(
        'options' => array(
            'min_range' => 1,
            'max_range' => $limit,
        ),
    );
    
    foreach ($fruits as $gyumolcs => $mennyiseg) {
        $adat = filter_var($mennyiseg, FILTER_VALIDATE_INT, $egyeniSzuro);
        //echo "$gyumolcs : $mennyiseg <br/> ";
        //echo '<pre>';
        //var_dump($adat);
        //echo '</pre>';

        if ($adat == false) {
            $hiba[$gyumolcs] = '<span style="color: red;">Maximum '.$limit.' kg fér el a raktárban</span>';
            //var_dump($hiba);
        }
    }

    if (empty($hiba)) {
        $output = '<table border="1" style="border-collapse: collapse;">';
        $output .= '<tr>'
                .'<th>Alma</th>'
                .'<th>Szőlő</th>'
                .'<th>Meggy</th>'
                .'<th>Barack</th>'
                .'<th>Banán</th>'
                .'<th>Hozzáadva</th>'
                .'</tr>'
                .'<tr>'
                .'<td>'.$fruits["alma"].' kg </td>'
                .'<td>'.$fruits["szolo"].' kg </td>'
                .'<td>'.$fruits["meggy"].' kg </td>'
                .'<td>'.$fruits["barack"].' kg </td>'
                .'<td>'.$fruits["banan"].' kg </td>'
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
        <title>Gyümölcs-nagykereskedés</title>
        <style>
            .mezo {
                width: 100px;
                margin-left: 40px;
            }

            table {
                text-align: center;
            }

            td {
                width: 80px;
            }

        </style>
    </head>
    <body>
        <?php

        if ($output != '') {
            echo $output;
            exit();
        }

        ?>
        <form method="post">
            <label for="fruits[alma]">Alma</label>
            <input type="text" name="fruits[alma]" id="fruits[alma]" class="mezo" placeholder="Mennyiség (kg)" value="<?php echo filter_input(INPUT_POST, 'fruits', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY)['alma'];?>"/>
            <?php echo (empty($hiba['alma']) ? "" : $hiba['alma']); ?>
            <br/>
            <label for="fruits[szolo]">Szőlő</label>
            <input type="text" name="fruits[szolo]" id="fruits[szolo]" class="mezo" placeholder="Mennyiség (kg)" value="<?php echo filter_input(INPUT_POST, 'fruits', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY)['szolo'];?>"/>
            <?php echo (empty($hiba['szolo']) ? "" : $hiba['szolo']); ?>
            <br/>
            <label for="fruits[meggy]">Meggy</label>
            <input type="text" name="fruits[meggy]" id="fruits[meggy]" class="mezo" placeholder="Mennyiség (kg)" value="<?php echo filter_input(INPUT_POST, 'fruits', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY)['meggy'];?>"/>
            <?php echo (empty($hiba['meggy']) ? "" : $hiba['meggy']); ?>
            <br/>
            <label for="fruits[barack]">Barack</label>
            <input type="text" name="fruits[barack]" id="fruits[barack]" class="mezo" placeholder="Mennyiség (kg)" value="<?php echo filter_input(INPUT_POST, 'fruits', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY)['barack'];?>"/>
            <?php echo (empty($hiba['barack']) ? "" : $hiba['barack']); ?>
            <br/>
            <label for="fruits[banan]">Banán</label>
            <input type="text" name="fruits[banan]" id="fruits[banan]" class="mezo" placeholder="Mennyiség (kg)" value="<?php echo filter_input(INPUT_POST, 'fruits', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY)['banan'];?>"/>
            <?php echo (empty($hiba['banan']) ? "" : $hiba['banan']); ?>
            <br/>
            <input type="submit" name="submit" value="Hozzáad"/>
        </form>
    </body>
</html>