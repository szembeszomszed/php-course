<?php

$int = 1;
$filteredInt = filter_var($int, FILTER_VALIDATE_INT);
if ($filteredInt != false) {
    echo "$int is an integer";
} else {
    echo "$int is NOT an integer";
}

/*
echo '<pre>';
var_dump($filteredInt);
echo '</pre>';
*/

/************************/

$str = '<h1>Karcsi!ÆØÅ</h1>';
echo '<br/>';
$newStr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
echo $newStr;

/************************/

$email = 'teszt@teszt.hu';
echo '<br/>';
$filteredEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
if ($filteredEmail != false) {
     echo "$email is in valid email format";
} else {
    echo "$email is NOT in valid email format"; 
}

echo '<br/>';

/***************************/

$myArray = [
    'name' => 'karcsi', 
    'age' => 42, 
    'email' => 'info@karcsi.hu',
];

$customFilters = [
    'name' => [
        'filter' => FILTER_CALLBACK, 
        'flags' => FILTER_FORCE_ARRAY,
        'options' => 'ucwords', // the function being called by FILTER_CALLBACK
        ],
    'age' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => [
            'min_range' => 1,
            'max_range' => 120,
            ],
        ],
    'email' => FILTER_VALIDATE_EMAIL,
];

$filteredArray = filter_var_array($myArray, $customFilters);

echo '<pre>';
var_dump($filteredArray);
echo '</pre>';

function convertSpace($str) {
    return str_replace(" ", "_", $str);
}

$string = 'karcsi es lajcsi jo baratok';

$convertedStr = filter_var($string, FILTER_CALLBACK, array ('options' => 'convertSpace'));

echo '<pre>';
var_dump($convertedStr);
echo '</pre>';

function power($number) {
    return $number * $number;
}

$num = 150;

$powerNum = filter_var($num, FILTER_CALLBACK, array ('options' => 'power'));

echo '<pre>';
var_dump($powerNum);
echo '</pre>';

/********************/

?>



<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="post">
            <label for=account>Enter your login name</label>
            <input type="text" name="account" placeholder="login">
            <input type="submit" name="submit" value="Post!">
        </form>
    </body>

</html>

<?php

function domainConc($str) {
    return $str.'@gmail.com';
}

if (filter_input(INPUT_POST, 'submit')) {
    $account = filter_input(INPUT_POST, 'account', FILTER_CALLBACK, array ('options' => 'domainConc'));
    
    echo $account;
}

echo "<br/>";

?>

