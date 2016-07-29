<?php

/* 
3) Írjunk egy eljárást, melynek segítségével fordítva írunk ki egy sztringet
 */

function reverseString($string) {
    $n = strlen($string);
    if ($n == 1) { // 1 karakteres szöveg esetén nyilván nem fordítgatunk semmit
        return $string; 
    } else {
        return reverseString(substr($string, 1, $n)). substr($string, 0, 1);
    }
}

echo reverseString('1234');
echo '<br/>';
echo reverseString('Ram nemet nem lel, elmentem en mar');
echo '<br/>';
echo reverseString('karcsi');

echo '<br/>';
echo substr('karcsi', -3);

echo '<br/>';
echo substr("karcsi", 1, strlen("karcsi"));
echo '<br/>';
echo substr('karcsi', 0, 1);

echo '<br/>';
echo substr("arcsi", 1, strlen("arcsi"));
echo '<br/>';
echo substr('arcsi', 0, 1);

