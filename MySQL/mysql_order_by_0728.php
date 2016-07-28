<?php

mysql_connect("localhost", "root", "") or die("csatlakozás sikertelen, mert: ".mysql_error());
mysql_select_db("tesztdb") or die(mysql_error());

echo '<p>Sikeresen csatlakoztunk az adatbázishoz!</p>';




// ha egy adott mező alapján szeretnénk rendezni, akkor azt az ORDER BY `mezőneve` utasítás segítségével tehetjük meg

$result = mysql_query("SELECT * FROM pelda ORDER BY age") or die(mysql_error());
// tehát ez az 'age' oszlopban lévő adatok alapján rendezi a táblázatot - jelen esetben növekvő sorrendbe rakja a korokat

echo '<table border="1">';
echo '<tr><th>Név</th><th>Kor</th></tr>';

while($row = mysql_fetch_array($result)) {
    echo '<tr><td>'.$row['name'].'</td><td>'.$row['age'].'</td></tr>';
}

echo '<table>';