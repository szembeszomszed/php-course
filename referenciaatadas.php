<?php

// 1 bájtos integer típusú változó, futás közben memória-címben van tárolva
// minden változó lokális, amíg nem definiáljuk másképp

// referenciaátadás - átadjuk a változó referenciáját
// referenciaátadás - ugyanazt a memóriaterületet használjuk
$a = 1;
novel($a);
echo $a;

function novel(&$num) {
	$num++;
}