<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Házi feladat megoldások</title>
        <style>
            .hf-3 table {
                width: 100%;
                border: 1px solid black;
                border-collapse: collapse;
            }
            
            .hf-3 td {
                border: 1px solid black;
                text-align: right;
                vertical-align: top;
                height: 50px;
            }
        </style>
    </head>
    <body>
        <section>
            <h2>1. feladat</h2>
            <p>Természetes számos feladat</p>
        
        <?php
            $sum = 0;
            for ($i = 1; $i <= 100; $i++) {
                $sum += $i;
            }
            echo 'A számok összege 1-től 100-ig: '.$sum;
        ?>
            
        </section>
        <section>
            <h2>2. feladat</h2>
            <p>Páros számos feladat</p>
            <?php
            $sum = 0;
            for ($i = 1; $i <= 50; $i++) {
                $sum += $i * 2;
            }
            echo 'A páros számok összege 1-től 100-ig: '.$sum; 
            ?>
        </section>
        <section class='hf-3'>
            <h2>3. feladat</h2>
            <p>Táblázat és Google szó véletlenszerű sorokkal és oszlopokkal</p>
            <table>
                <?php
                    $cellak = rand(5, 10); // cellák száma
                    $sorok = rand(2, 7); // sorok száma
                    for ($i = 1; $i <= $sorok; $i++) {
                        echo '<tr>'; // sor kezdése
                        for ($j = 0; $j <= $cellak; $j++) {
                            echo '<td>Google</td>'; // egy cella kiíratása
                        }
                        echo '</tr>'; // sor lezárása
                    }
                ?>               
            </table>
        </section>
        <section class='szines-tablazat'>
            <h2>4. feladat</h2>
            <p>Véletlen sor- és oszlopszámú, véletlen háttérszínű táblázat</p>
            <table>
            <?php
            
                $cellak = rand(40, 70);
                $sorok = rand(20, 40);
                
                for ($i = 1; $i <= $sorok; $i++) {
                    echo '<tr>'; // sor kezdése
                    for ($j = 1; $j <= $cellak; $j++) {
                        $r = rand(0, 255);
                        $g = rand(0, 255);
                        $b = rand(0, 255);
                        echo '<td style="background-color: rgb('.$r.','.$g.','.$b.')">&nbsp;</td>'; // az &nbsp szóköznek felel meg, az lesz itt a cella tartalma
                    }
                    echo '</tr>';
                }
            
            ?>
            </table>            
        </section>
        <section>
           <h2>5. feladat</h2>
           <p>Lépcsőzetes kiíratás</p>
           <?php
           /*
            * 2
            * 22
            * 222
            * 2222
            */
           
           /* EGYIK MEGOLDÁS 
           for ($i = 1; $i <= 4; $i++) {
                echo '<br/>';
                for ($j = 1; $j <= $i; $j++) {
                    echo '2';
                }
            }
            */
           // MÉG SZEBB MEGOLDÁS, MEGSPÉKELVE A VISSZALÉPCSŐVEL
            for ($i = 1; $i <= 4; $i++) {
                echo '<br/>'.str_repeat('2', $i); // adott számszor megismétli a stringet - itt '2' * $i
            }
            for ($i = 4; $i >= 1; $i--) {
                echo '<br/>'.str_repeat('2', $i);
            }
           
           ?>
        </section>
        <section>
           <h2>6. feladat</h2>
           <p>Számok átlaga 1-10</p>
           <?php
            $sum = 0;
            for ($i = 1; $i <= 10; $i++) {
                $sum += $i;
            }
            
            $atlag = $sum / $i--;
            echo 'A számok átlaga 1-től 10-ig: '.$atlag;
           ?>
        </section>
    </body>
</html>
