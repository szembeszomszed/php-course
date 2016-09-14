<?php

// címkezelő osztály betöltése
require ('class.Address.inc');

echo '<h2>Címkezelő osztály példányosítása (üres példány)</h2>';

// osztály megszólítása
$address = new Address;

// a var_export a true-val stringként tér vissza, és nem void lesz
echo '<pre>'.  var_export($address, true).'</pre>';

echo '<h2>Objektumtulajdonságok "feltöltése" </h2>';

// obj tulajdonsága (property) a nyíl után, majd értékadás
$address->street_address_1 = "Frangepán utca 23.";
$address->city_name = "Budapest";
$address->subdivision_name = "Angyalföld";
//$address->postal_code = 1138;
$address->country_name = "Magyarország";
//$address->valami="bármi";
echo '<pre>'.  var_export($address, true).'</pre>';

echo '<h2>Cím kiírása az osztályban deklarált display metódussal</h2>';
echo $address->display();

echo '<h2>Objektum létrehozása tömbből konstruktor segítségével</h2>';
$data = [
    'street_address_1'=>'Kossuth tér 2.',
    'city_name'=>'Paks',
    'country_name'=>'Magyarország',    
];

$address_2 = new Address($data);
echo $address_2->display();
echo '<pre>'.var_export($address_2, true).'</pre>';


