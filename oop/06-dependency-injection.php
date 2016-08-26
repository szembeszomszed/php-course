<?php

require 'Chest.php';
require 'Lock.php';

// create a new Chest instance and pass a new Lock object to it as argument
// if we pass a string, the methods invoked will not be available as a string wouldn't have them
$chest = new Chest(new Lock);
$chest->close();
$chest->open();