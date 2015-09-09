<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
try {
  $dsn = 'mysql:host=localhost;dbname=sql_edu';
  $dbh = new PDO($dsn, 'root', '19911991');
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Failed! ' . $e->getMessage();
}

$sql = 'SELECT * FROM users';
$results = $dbh->query($sql);

var_dump($results);