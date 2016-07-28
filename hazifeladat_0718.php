<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        // 1. FELADAT

        echo '<h4>1. feladat: a számok összege 1-től 100-ig</h4>';

        $myArray = [];
        for($i = 1; $i < 101; $i++) {
        	$myArray[] = $i;
        }
        
        //var_dump($myArray);
        //echo '<br/>';
        echo implode(' + ', $myArray) . ' = <strong>'.array_sum($myArray) . '</strong>';
        
        //echo 'Az összeg: '. array_sum($myArray) .'<br/>';

        //2. FELADAT

        echo '<h4>2. feladat: a páros számok összege 1-től 100-ig</h4>';
        
        $myArray2 = [];
        for($i = 1; $i < 101; $i++) {
            if($i % 2 == 0) {
                $myArray2[] = $i;
            }
        }

        echo implode(' + ', $myArray2) . ' = <strong>' . array_sum($myArray2) . '</strong>';

        //var_dump($myArray2);
        //echo '<br/>';
        //echo 'Az összeg: ' . array_sum($myArray2) . '<br/>';

        // 3. FELADAT

        echo '<h4>3. feladat: táblázat véletlen számú sorral és oszloppal, a cellák jobb felső sarkába rendezett szóval</h4>';

        $row = rand(2, 10);
        $column = rand(2, 10);
        echo '<table border="1" style="border-collapse: collapse">';

        for($i = 1; $i <= $row; $i++) {
            echo '<tr>';
            for($j = 1; $j <= $column; $j++) {
                echo '<td style="width: 100px; height: 50px; text-align: right; vertical-align: text-top;">Google</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        // 4. FELADAT

        echo '<h4>4. feladat: táblázat véletlen számú sorral és oszloppal, véletlenül generált háttérszínnel</h4>';

        $row = rand(10, 50);
        $column = rand(10, 100);


        echo '<table border="1" style="border-collapse: collapse">';

        for($i = 1; $i <= $row; $i++) {
            echo '<tr>';
            for($j = 1; $j <= $column; $j++) {
                $r = rand(1, 256);
                $g = rand(1, 256);
                $b = rand(1, 256);
                echo "<td style=\"width: 5px; height: 10px; background-color: rgb($r, $g, $b);\"></td>";
            }
            echo '</tr>';
        }
        echo '</table>';

        // 5. FELADAT

        echo '<h4>5. feladat: számok lépcsőzetesen elrendezve</h4>';

        $maxRows = 16;

        echo '<table>';

        if ($maxRows % 2 == 0) {

            for ($row = 1; $row <= $maxRows; $row++) {
                echo '<tr>';
                if ($row < $maxRows / 2) {
                    for ($column = $row; $column >= 1; $column--) {
                        echo "<td>$column</td>";
                    }
                } else {
                    for ($column = $row; $column <= $maxRows -1; $column++) {
                        echo "<td>$column</td>";
                    }
                }
                echo '</tr>';
            }
         
        } else {

             for ($row = 1; $row <= $maxRows; $row++) {
                echo '<tr>';
                if ($row < $maxRows / 2) {
                    for ($column = $row; $column >= 1; $column--) {
                        echo "<td>$column</td>";
                    }
                } else {
                    for ($column = $row; $column <= $maxRows; $column++) {
                        echo "<td>$column</td>";
                    }
                }
                echo '</tr>'; 
            }  
         }

        echo '</table>';

        // 6. FELADAT

        echo '<h4>6. feladat: számok átlaga 1-től 10-ig</h4>';

        $myArray3 = [];

        for ($i = 1; $i <= 10; $i++) {
            $myArray3[] = $i;
        }

        $average = array_sum($myArray3) / count($myArray3);
        echo '(' . implode(' + ', $myArray3) . ') / ' . count($myArray3) . ' = ' . '<strong>' . $average . '<strong>';
        //echo 'A számok átlaga: ' . $average;       



        ?>
    </body>
</html>	