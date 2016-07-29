<!DOCTYPE html>
<!--
14) Írjunk egy PHP szkriptet ami kiirja a karakterünk után következő karaktert
	Példa adat: 'a'
	Output: 'b'
	Pálda adat: 'z'
	Output: 'a'
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $char = "z";
        $nextChar = ++$char;
        echo $nextChar.'<br/>';
        
        // nem működik még :O
        if (strlen($nextChar) > 1) {
            $nextChar = $nextChar[0];
            // z vagy Z beírását követően a stringemet alaphelyzetbe kell állítanom
            // ezért felüldefiniálom a nulladik pozícióval (hiszen a string array-ként viselkedik egyébként)
            
            // mivel a stringekben az egyes karaktereknek van indexük, ezért ezt tudjuk majd
            // a későbbiekben is aranyosan használni
        }      
        
           
        ?>
    </body>
</html>
