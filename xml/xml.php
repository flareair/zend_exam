<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$breakfast = new SimpleXMLElement('breakfast.xml', null, true);



foreach ($breakfast->children() as $child) {
  echo $child->name . '<br>';
}

$calories = $breakfast->xpath('food/calories');

foreach ($calories as $item) {
  echo $item . '<br>';
}

$newFood = $breakfast->addChild('food');
$newFood->addChild('name', 'borsh');

// header('Content-type: text/xml');
// echo $breakfast->asXML();

$dom = new DomDocument();
$dom->load('breakfast.xml');


$xpath = new DomXPath($dom);

$foodNames = $xpath->query('//food/name');


foreach ($foodNames as $child) {
  var_dump($child);
}