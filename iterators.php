<?php

ini_set('display_errors',1);
error_reporting(E_ALL);


class myArray implements ArrayAccess{
  protected $array = array();

  public function __construct(array $arr = array()) {
    $this->array = $arr;
  }

  public function offsetSet($key, $value) {
    $this->array[$key] = $value;
  }
  public function offsetGet($key) {
    if ($this->offsetExists($key)) {
      return $this->array[$key];
    }
    throw new Exception("Array key $key is undefined", 1);
  }
  public function offsetUnset($key) {
    unset($this->array[$key]);
  }
  public function offsetExists($key) {
    return array_key_exists($key, $this->array);
  }

}


$arr = [
  1 => 'one',
  'two' => 'number two',
  'three' => 3
];

$arr = new myArray($arr);

// var_dump($arr[1]);


class Seekable implements SeekableIterator {
  private $position = 0;
  private $array;

  public function __construct(array $array = null) {
    if (is_null($array) || count($array) === 0) {
      throw new Exception("Empty array given", 1);
    }
    $keys = array_keys($array);
    foreach ($keys as $key) {
      if (!is_integer($key)) {
        throw new Exception("Array should have only integer keys", 1);
      }
    }

    $this->array = $array;
  }

  public function seek($position) {
    if (!isset($this->array[$position])) {
      throw new Exception("Invalid seek position $position", 1);
    }

    $this->position = $position;
  }

  public function rewind() {
    $this->position = 0;
  }

  public function key() {
    return $this->position;
  }

  public function next() {
    ++$this->position;
  }

  public function valid() {
    return isset($this->array[$this->position]);
  }

  public function current() {
    return $this->array[$this->position];
  }
}


$seekable = new Seekable(['first', 'second', 'third']);

$seekable->seek(2);
$seekable->rewind();

// error
// $seekable->next();
// echo $seekable->current();

foreach ($seekable as $key => $value) {
  echo "$key: $value <br>";
}

echo $seekable->current();



echo '<br>';

function generator() {
  yield 'begin';
  yield 'this';
  yield 'shit';
  $i = 10;
  while ($i > 0) {
    yield 'iteration';
    yield $i;
    $i--;
  }
}

$gen = generator();

foreach ($gen as $number) {
  echo "$number <br>";
}

function generateTable($data) {
  yield '<table><tr><th>Key</th><th>Value</th></tr>';
  foreach ($data as $key => $value) {
    $string = "<tr><td>$key</td><td>$value</td></tr>";
    yield $string;
  }
  yield '</table>';
}

$data = [
  'first' => 'last',
  'one' => 'another',
  'blue' =>'print'
];

foreach (generateTable($data) as $string) {
  echo $string;
}

function logger() {
  while (true) {
    $message = yield;
    echo $message . PHP_EOL;
  }
}

$log = logger();

$log->send('Hello message');
$log->send('Bye message');