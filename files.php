<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

echo '<h1>Work with files</h1>';

$filePath = 'file.txt';

if (!file_exists($filePath)) {
  die("Can't find file");
}

$fileSize = filesize($filePath);

echo "<p>File size: $fileSize bytes</p>";

$file = fopen($filePath, 'r+');

print_r(fgetc($file));
echo '<br>';
// L
print_r(fgets($file));
echo '<br>';
// orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu
// Pointer moved!
fseek($file, 0);
// move pointer to the beginning of the file
while (!feof($file)) {
  $fileArray[] = fgets($file);
}
fseek($file, 0);
// move pointer to the beginning of the file

var_dump($fileArray);
// array with 7 strigs of file

echo '<br>';
print_r(fread($file, 5));
//  Lorem
echo '<br>';
fseek($file, 0);
// move pointer to the beginning of the file
fwrite($file, 'Another lorem');

readfile($filePath);
echo '<br>';
$file = file_get_contents($filePath);

var_dump($file);

$url = 'http://www.ya.ru';
$remote = fopen($url, 'r');
