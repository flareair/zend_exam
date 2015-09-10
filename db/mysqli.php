<?php

ini_set('display_errors',1);
error_reporting(E_ALL);


$dbh = mysqli_connect('localhost','root', '19911991', 'test');

if (!$dbh) {
  echo 'Connect failed: ' . mysqli_connect_error();
  exit;
}

$id = 2;

$sql = sprintf('select * from user where id <= %s', mysqli_real_escape_string($dbh, $id));

if (!mysqli_real_query($dbh, $sql)) {
  echo 'Error in query: ' . mysqli_error($dbh);
  exit;
}

if ($result = mysqli_store_result($dbh)) {
  echo "<pre>";
  while ($row = mysqli_fetch_assoc($result)) {
    var_dump($row);
  }
  echo "</pre>";
}


/* prepared */

$sql = "update user set name = \'Lullaby\' where id = ?";

if ($stmt = mysqli_prepare($dbh, $sql)) {
  mysqli_stmt_bind_param($stmt, 's', $id);
  mysqli_stmt_execute($stmt);
  $affected = mysqli_stmt_affected_rows($stmt);
  echo $affected;
}

else {
  echo "error!";
}


mysqli_close($dbh);


// this mysqli_ driver is a f**** shit