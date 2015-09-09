<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$library = new SimpleXMLElement('books.xml', null, true);

foreach ($library->children() as $child) {
  foreach ($child->children() as $subchild) {
    echo "{$subchild->getName()}: $subchild <br>";
  }
  echo $child->getName() . ' has attributes - ';
  foreach ($child->attributes() as $attr) {
    echo "{$attr->getName()}: $attr ";
  }
  echo '<br>';
  echo '<br>';
}


foreach ($library->xpath('book/*') as $title) {
  echo $title . '<br>';
}

$newBook = $library->addChild('book');
$newBook->addAttribute('isbn', '123456');
$newBook->addChild('title', 'Lullaby');
$newBook->addChild('author', 'C. Palaniuk');
$newBook->addChild('publisher', 'Altbook');

$library->asXML('library.xml');

// $removedNode = $library->xpath('book[last()]');

// var_dump($removedNode);

// $removedNode = null;
// unset($removedNode);
// $library->asXML('library.xml');

$library->book[$library->count() - 1] = null;
unset($library->book[$library->count() - 1]);
$library->asXML('library.xml');


echo '<br><br>';

$namespacedLibrary = new SimpleXMLElement('namespacedlibrary.xml', null, true);

var_dump($namespacedLibrary->getDocNamespaces());
echo '<br><br>';
var_dump($namespacedLibrary->getNamespaces(true));
echo '<br><br>';

$namespaces = $namespacedLibrary->getNamespaces(true);
// $namespacedLibrary->registerXPathNamespace('meta', $namespaces['meta']);

// $firstItem = $namespacedLibrary->book[0];

// echo $firstItem->a

$attr = $namespacedLibrary->book[0]->attributes($namespaces['meta']);

var_dump($attr);
