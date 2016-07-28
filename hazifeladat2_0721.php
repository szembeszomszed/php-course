<?php

$countries = array(
    $country1 = array(
        'countryName' => 'Hungary',
        'capitalCity' => 'Budapest',
        'officialLanguage' => 'Hungarian',
        ),
    $country2 = array(
        'countryName' => 'Germany',
        'capitalCity' => 'Berlin',
        'officialLanguage' => 'German',
        ),
    $country3 = array(
        'countryName' => 'Spain',
        'capitalCity' => 'Madrid',
        'officialLanguage' => 'Spanish',
        ),
    );

/*
foreach ($countries as $country) {
    //foreach ($country as $key => $value) {
        //echo "$key : $value";
        echo 'The capital city of ' .$country['countryName']. ' is '. $country['capitalCity'] . '. ';        
    //}
}
*/

/*
echo '<pre>';
var_dump($countries);
echo '</pre>';
*/


$Hungary = array(
    'capitalCity' => 'Bp');

$countries[]['countryName'] = 'Latvia';
$countries[3]['capitalCity'] = 'Riga';
$countries[3]['officialLanguage'] = 'Latvian';

/*

$countryToCheck = 'Germany';

foreach ($countries as $country) {
    if ($countryToCheck == $country['countryName']) {
        echo '<br/>';
        echo 'Country found.';
    } else {
        echo '<br/>';
        echo 'Country not found.';
    }
}    

*/

//unset($countries[3]);

//$countries[0]['countryName'] = 'Hungary';
/*
echo '<pre>';
var_dump($countries);
echo '</pre>';
*/

//unset($countries[3]['countryName']);

/*
echo '<pre>';
var_dump($countries);
echo '</pre>';
*/

/*
echo '<pre>';
//var_dump($Hungary['capitalCity']);

for ($i=0; $i < count($Hungary) ; $i++) { 
    echo $Hungary['capitalCity'];
}

echo '</pre>';
*/

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="get">
            <fieldset>
                <select name="country">
                    <option value="0">-----Select country-----</option>
                    <option value="1">Hungary</option>
                    <option value="2">Germany</option>
                    <option value="3">Spain</option>
                    <option value="4">Latvia</option>
                </select>
                <input type="submit" name="submit" value="Select"/>
            </fieldset>
        </form>
    </body>
</html>

<?php

if (filter_input(INPUT_GET, 'submit')) {
    $choice = filter_input(INPUT_GET, 'country');
    
    //echo '<pre>';
    //var_dump($choice);
    //echo '<pre>';

    foreach ($countries as $index => $country) {
        if ($index == $choice - 1) {
            echo 'Selected country is: '.$country['countryName'].'.<br/>
            Its capital city is: ' .$country['capitalCity'].'.<br/>
            Its official language is: ' .$country['officialLanguage'].'.<br/>';
        }
    }

}

?>