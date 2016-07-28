<?php

/*
10) Írjunk egy PHP szkriptet ami lecseréli az ugrik szót szalad szóra
    Példa adat: 'A róka nagyon gyorsan ugrik, és aki az erdőben él és ugrik.'
    Output: 'A róka nagyon gyorsan szalad, és aki az erdőben él és szalad.'
*/

$text = 'A róka nagyon gyorsan ugrik, és aki az erdőben él és ugrik.';
$word1 = 'ugrik';
$word2 = 'szalad';

$newText = str_replace($word1, $word2, $text);
echo $newText;