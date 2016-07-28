<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        
        <form method="post">
            <fieldset>
                <input type="radio" name="charnumber" value="6"/>
                <label for="charnumber">6</label>
                <input type="radio" name="charnumber" value="7"/>
                <label for="charnumber">7</label>
                <input type="radio" name="charnumber" value="8"/>
                <label for="charnumber">8</label>
                <input type="radio" name="charnumber" value="9"/>
                <label for="charnumber">9</label>
                <input type="radio" name="charnumber" value="10"/>
                <label for="charnumber">10</label>
                <input type="radio" name="charnumber" value="11"/>
                <label for="charnumber">11</label>
                <input type="radio" name="charnumber" value="12"/>
                <label for="charnumber">12</label>

                <br/>
                <br/>
                <input type="checkbox" name="characters[0]" value="1">
                <label for="characters[0]">1234567890</label>
                <br/>
                <input type="checkbox" name="characters[1]" value="1">
                <label for="characters[1]">ABCDEFGHIJKLMNOPQRSTUVWXYZ</label>
                <br/>
                <input type="checkbox" name="characters[2]" value="1">
                <label for="characters[1]">abcefghijklmnopqrstuvwxyz</label>
                <br/>
                <input type="checkbox" name="characters[3]" value="1">
                <label for="characters[1]">!"#$%()*+,-./:;<=>?@[\]_{|}</label>
                <br/><br/>
                <input type="submit" name="submit" value="Generate!">
            </fieldset>



        </form>

    </body>

</html>


<?php

$characters = ['1234567890', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcefghijklmnopqrstuvwxyz', '!"#$%()*+,-./:;<=>?@[\]_{|}'];

if(filter_input(INPUT_POST, 'submit')) {

    $customFilter = [
        "characters" => [
            'flags' => FILTER_REQUIRE_ARRAY,
        ],
    ];

    $characterChoice = filter_input_array(INPUT_POST, $customFilter);

    //echo '<pre>';
    //var_dump($characterChoice);
    //echo '</pre>';

    $passwordString = "";

    foreach($characters as $key => $string) {

        if (isset($characterChoice['characters'][$key])) {
            $passwordString.=$string;
        }

    }

    //echo '<pre>';
    //var_dump($passwordString);
   // echo '</pre>';

    $numberChoice = filter_input(INPUT_POST, 'charnumber');
    //echo '<pre>';
    //var_dump($numberChoice);
    //echo '</pre>';

    echo '<br/><br/>';

    echo '<h2 style="text-align: center;"> your password: <br/><br/>  '.substr(str_shuffle($passwordString), 0, $numberChoice).'</h2>';
}
?>