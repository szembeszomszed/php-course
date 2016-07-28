<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<pre>
<form method="post">
    num<input type="checkbox" name="num">
    uc<input type="checkbox" name="uc">
    lc<input type="checkbox" name="lc">
    misc<input type="checkbox" name="misc">
    <input type="submit" name="submit">
</form>
</body>
</html>

<?php

if (isset($_POST['submit'])) {
    $characters = [
        'num'  => '1234567890',
        'uc'   =>'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'lc'   => 'abcefghijklmnopqrstuvwxyz',
        'misc' => '!"#$%()*+,-./:;<=>?@[\]_{|}'
    ];

    $foo = '';

    foreach ($characters as $key => $value) {
        if (isset($_POST[$key])) {
            $foo .= $value;
        }
    }

    echo $foo;
}
/**
 * Created by PhpStorm.
 * User: mate
 * Date: 2016.07.27.
 * Time: 16:11
 */