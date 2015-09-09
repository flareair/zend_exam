<?php

echo '<h2>Strings</h2>';
$string = 'Look at me';
echo strstr($string, 'at') . '<br>';
// at me

echo strtr($string, 'at', 'nea') . '<br>';
// Look ne me

$needles = [
  'a' => 'i',
  't' => 'n'
];

echo strtr($string, $needles) . '<br>';
// Look in me


echo strtok($string, 'km') . '<br>';
echo strtok('km') . '<br>';
echo strtok('km') . '<br>';
/*
Loo
at
e
*/

echo strlen($string) . '<br>';
// 10
echo strspn($string, 'atm ', 5, 2) . '<br>';
// 2
echo strcspn($string, 'Lo') . '<br>';
// 0
echo strcspn($string, 'k') . '<br>';

echo str_replace('Look', 'Work', $string) . '<br>';
// Work at me
echo str_replace('oo', 'ea', $string) . '<br>';
// Leak at me
str_replace('o', 'e', $string, $count) . '<br>';
echo $count . '<br>';
// 2

echo str_replace([
    'o', 'e'
  ],
  [
    'n', 'ia'
  ],
  $string) . '<br>';
// Lnnk at mia


echo substr_replace($string, 'him', 8) . '<br>';
// Look at him
echo substr_replace($string, 'Work', 0, 4) . '<br>';
// Work at me


echo number_format(100000.823124) . '<br>';
// 100,001
echo number_format(100000.823124, '2', '.', ' ') . '<br>';
// 100 000.82


printf('%.3f', 100500.124124);
echo '<br>';
// 100500.124
echo $output = sprintf('This is a string "%s"', $string);
echo '<br>';
// This is a string "Look at me"

$input = 'Number 6996.555413';
$array = sscanf($input, '%s %f');

var_dump($array);
echo '<br>';
// array(2) { [0]=> string(6) "Number" [1]=> float(6996.555413) }

$mail = 'flare.ad_min@mail.com';
$wrongMail = 'asd@inset.ru';
$regexp = '/^[a-z0-9\._]+@{1}[a-z0-9]+[\.]{1}[a-z0-9\._]+$/';
var_dump(preg_match($regexp, $mail));
echo '<br>';
var_dump(preg_match($regexp, $wrongMail));
echo '<br>';


$string = '10-12-2011 10:55 Error: Can\'t connect to DB';

// $regexp = '/^(?<date>[0-9]-)/s(?<time>[0-9]:)/s(?<loglevel>[A_Za-z]:)\s(?<message>/w+)/';
$regexp = '/^(?<date>\d{2}-\d{2}-\d{4})\s(?<time>\d{2}:\d{2})\s(?<type>\w+):\s(?<message>.*)$/';

$matches = array();

$result = preg_match($regexp, $string, $matches);

foreach ($matches as $key => $value) {
  if (is_int($key)) {
    unset($matches[$key]);
  }
}

echo '<pre>';
var_dump($matches);
echo '</pre>';

$phone = '+79112441321';
$regexp = '/(\+?\d{1})(\d{3})(\d{2,3})(\d{2})(\d{2})$/';


preg_match($regexp, $phone, $matches);

echo '<pre>';
var_dump($matches);
echo '</pre>';

$replace = '$1 ($2) $3-$4-$5';

$result = preg_replace($regexp, $replace, $phone);

echo '<br>';
echo $result;
echo '<br>';
$str = 'abcd';

echo substr($str, 0, 1);
echo substr($str, 0, -1);
echo substr($str, 3, 1);
echo substr($str, 3);
echo substr($str, -3);

echo '<br>';

echo strcmp('abc100', 'abc20');
echo '<br>';
echo strnatcmp('abc10', 'abc2');

echo '<br>';
printf('%2$+.3f %1$+\'_12.3f', -13123.13, +999.76);
echo '<br>';
printf('%10.2f', 313.14123);

