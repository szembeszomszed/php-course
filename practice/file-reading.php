<?php


$filename = 'C:\xampp\htdocs\practice\test.txt';
$file = fopen($filename, 'r');
if ($file == false) {
    echo "error in opening file";
    exit();
}

// OTHER READING EXAMPLE IN FILE-WRITING.PHP
$i = 0;
$lineCount = 0;
while (!feof($file)) {
    $contents[$i++] = fgets($file);
    $lineCount++;
}
print_r($contents);

echo '<br/>';

for ($i = 0; $i < $lineCount; $i++ ) {
    echo $contents[$i];
}

echo '<br/>';

foreach ($contents as $lineNumber => $line) {
    $lineNumber = $lineNumber + 1;
    echo "$lineNumber: $line <br/>";
}

fclose($file);
