<!DOCTYPE html>
<!--
13) Írjunk egy PHP szkriptet, ami táblázatba írja az alábbi értékeket (2 oszlop, 3 sor)
    Output:
	   Bélabácsi fizetése: 120000Ft
	   Mariska fizetése: 100000Ft
	   Juliska fizetése: 40000Ft
-->

<?php

$people = [
    'Bélabácsi' => 120000,
    'Mariska' => 100000,
    'Juliska' => 40000    
];

echo '<table border="1" style="border-collapse: collapse;">';

foreach ($people as $person => $salary) {
    echo "<tr>";
    echo "<td>$person fizetése </td>"; 
    echo "<td>$salary Ft</td>";
    echo "</tr>";
}    

echo '</table>';

/*

$a = 120000;
$b = 100000;
$c = 40000;

echo "<table border=\"1\""
."<tr>"
."<td>Bélabácsi fizetése: </td>"
."<td>$a Ft </td>"
."</tr>"
."<tr>"
."<td>Mariska fizetése: </td>"
."<td>$b Ft </td>"
."</tr>"
."<tr>"
."<td>Juliska fizetése: </td>"
."<td>$c Ft </td>"
."</tr>"
."</table>";

*/


