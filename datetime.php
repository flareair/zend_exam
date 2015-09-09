<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$format = 'd-m-y H:i';

$today = new DateTime();
$yesterday = DateTime::createFromFormat($format, '15-07-15 10:15');

echo $today->format($format), '<br>';

var_dump($today->diff($yesterday));

echo '<br>';

$today->setDate('2016','03', '04');
echo $today->format($format), '<br>';
echo $today->format(DateTime::ATOM), '<br>';
echo $today->format(DateTime::RSS), '<br>';