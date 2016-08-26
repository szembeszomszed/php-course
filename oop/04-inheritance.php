<?php

require 'bird.php';
require 'pigeon.php';
require 'penguin.php';

$pigeon = new Pigeon(true, 2, "everywhere", false);

echo $pigeon->getLegCount();
echo '<br/>';

if ($pigeon->canFly()) {
    echo "can fly <br/>";
}

$penguin = new Penguin(false, 2, "South", true);

echo $penguin->getLegCount();
echo '<br/>';

if ($penguin->canFly()) {
    echo "can fly";
} else {
    echo "can't fly";
}

echo '<br/>';

$penguin->foo();

$penguin->bar();