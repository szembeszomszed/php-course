<?php

$filename = 'c:\xampp\htdocs\practice\test.txt';
$file = fopen($filename, 'a');
if (!$file) {
    echo "error in opening file";
    exit();
}

fwrite($file, "let's see if we can add this line");
fclose($file);

// read file

$filename = 'c:\xampp\htdocs\practice\test.txt';
$file = fopen($filename, 'r');

if (!$file) {
    echo "error in opening file";
    exit();
}

$fileSize = filesize($filename);
$fileText = fread($file, $fileSize);

fclose($file);

echo "Filesize is $fileSize bytes <br/>";
echo "<pre>$fileText</pre>";

