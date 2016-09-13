<?php

//címkezelő osztály betöltése
require ('class.Address.inc');

echo '<h2>Címkezelő osztály példányosítása (üres példány)</h2>';

// osztály megszólítása
$address = new Address;

// a var_export a true-val stringként tér vissza, és nem void lesz
echo '<pre>'.  var_export($address, true).'</pre>';

