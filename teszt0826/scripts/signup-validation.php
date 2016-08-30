<?php

if (filter_input(INPUT_POST, 'submit')) {

    if (!empty(filter_input(INPUT_POST, 'username')) &&
        !empty(filter_input(INPUT_POST, 'email')) &&
        !empty(filter_input(INPUT_POST, 'gender')) &&
        !empty(filter_input(INPUT_POST, 'age')) &&
        filter_input(INPUT_POST, 'location') > 0) {

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender');
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $location = filter_input(INPUT_POST, 'location');

    } else {
        $error['signup'] = '<p style="color: red; display: inline; margin-left: 5px;">Please make sure to provide all data.</p>';
    }
}