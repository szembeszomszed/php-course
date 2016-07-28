<?php

if (filter_input(INPUT_POST, 'submit')) {
    $error = [];

    $userData = filter_input(INPUT_POST, 'signup', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

    echo '<pre>';
    var_dump($userData);
    echo '</pre>';

    $customFilter = [
        'username' => [
            'filter' => FILTER_CALLBACK,
            'flags' => FILTER_FORCE_ARRAY,
            'options' => 'strtolower',
        ],
        'email' => FILTER_VALIDATE_EMAIL,
    ];

    /*
    foreach ($userData as $type => $data) {
        $signupData = filter_var($data, $customFilter);
        echo '<pre>';
        var_dump($signupData);
        echo '</pre>';
    }
    */

    $signupData = filter_var_array($userData, $customFilter);
    echo '<pre>';
    var_dump($signupData);
    echo '</pre>';

}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <br/>
        <form method="post">
            
            <input type="text" name="signup[username]" placeholder="username">
            <br/>
            <input type="text" name="signup[email]" placeholder="email">
            <br/>
            <input type="submit" name="submit" value="Sign up!">

        </form>
    </body>

</html>

