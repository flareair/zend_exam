<?php
ini_set('display_errors',1);
error_reporting(E_ALL);


class Foo {
  private $a;
  function __construct() {
    $this->a = 10;
  }
}

$bar = new Foo();

echo $bar->a;
// Fatal error!