<!DOCTYPE html>
<!--
12) Írjunk egy PHP szkriptet, ami leellenörzi hogy az email cím valós e?
-->

<?php
/* EZ FORM NÉLKÜL ELLENŐRIZ ARANYOSAN
  $email = 'sanyi@karcsi.hu';
  if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
  echo "<strong>$email</strong> is valid";
  } else {
  echo "<strong>$email</strong> is NOT valid";
  }
 * 
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method='post'>
            <input type="text" name="email" placeholder="minta@minta.hu">
            <input type="submit" name="submit" value="ellenőriz">
        </form>
        <br/>
<?php
if (filter_input(INPUT_POST, 'submit')) {
    $email = filter_input(INPUT_POST, 'email');

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<strong>$email</strong> is valid";
    } else {
        echo "<strong>$email</strong> is NOT valid";
    }
}
?>
    </body>
</html>
