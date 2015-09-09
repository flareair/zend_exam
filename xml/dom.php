<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$dom = new DomDocument();

$dom->load("namespacedlibrary.xml");

// loadXML string
// loadHTNL string
// loadHTMLFile filepath

// save file
// saveXML string
// saveHTML string
// saveHTMLFile file


$xpath = new DomXPath($dom);
$xpath->registerNamespace('pub', 'http://example.org/publisher');
$result = $xpath->query('//pub:publisher/text()');


foreach ($result as $publisher) {
  echo $publisher->data . ' with length: ' . $publisher->length . ' / ';
}

// var_dump($publisher);

echo "<br><br>";

$result = $xpath->query('//pub:publisher');

foreach ($result as $publisher) {
  echo $publisher->nodeValue . ' / ';
}

echo "<br><br>";

$newBook = $dom->createElement('book');
$newBook->setAttribute('meta:isbn', "1444123123");
$title = $dom->createElement('title');
$text = $dom->createTextNode('War &amp; Peace');

$title->appendChild($text);
$newBook->appendChild($title);

$author = $dom->createElement('author', 'Tolstoi');
$newBook->appendChild($author);

$publisher = $dom->createElement('pub:publisher', 'EKSMO');
$newBook->appendChild($publisher);

$dom->documentElement->appendChild($newBook);
$dom->save('namespacedlibrary.xml');

$xpath = new DomXPath($dom);
$xpath->registerNamespace('lib', 'http://example.org/library');
$result = $xpath->query('//lib:book');

// var_dump($result);

$result->item(1)->parentNode->insertBefore(
  $result->item(3), $result->item(2)
);

$dom->save('namespacedlibrary.xml');

$result = $xpath->query('//lib:book');

$result->item(1)->parentNode->appendChild($result->item(0));
$dom->save('namespacedlibrary.xml');


$xpath = new DomXPath($dom);
$xpath->registerNamespace('lib', 'http://example.org/library');

$result = $xpath->query('//author/text()');

var_dump($result->item(0)->data);

$result->item(0)->data = strtolower($result->item(0)->data);

$dom->save('namespacedlibrary.xml');
