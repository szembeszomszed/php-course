<?php

require 'bird.php';
require 'pigeon.php';
require 'penguin.php';

$pigeon = new Pigeon(true, 2);

echo $pigeon->getLegCount();
echo '<br/>';

if ($pigeon->canFly()) {
    echo "can fly <br/>";
}

$penguin = new Penguin(false, 2);

echo $penguin->getLegCount();
echo '<br/>';

if ($penguin->canFly()) {
    echo "can fly";
} else {
    echo "can't fly";
}