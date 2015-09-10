<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

function outputResult($results) {
  echo "<pre>";
  foreach ($results as $row) {
    var_dump($row);
  }
  echo "</pre>";
}

try {
  $dsn = 'mysql:host=localhost;dbname=test;charset=utf8';
  $dbh = new PDO($dsn, 'root', '19911991');
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


  /*
    Direct manipulations
  */

  $sql = 'SELECT * FROM user';
  $results = $dbh->query($sql);

  $results->setFetchMode(PDO::FETCH_OBJ);

  outputResult($results);

  $sql = 'insert into user (id, name, age) values (5, \'Broke\', 22) on duplicate key update id = id';

  $affected = $dbh->exec($sql);

  $sql = 'insert into user (id, name, age) values (6, \'Nancy\', 31) on duplicate key update id = id';

  $affected += $dbh->exec($sql);
  echo "While insertions affected $affected rows. <br>";

  $sql = 'update user set name=\'Cristof\' where id=\'1\'';

  $affected = $dbh->exec($sql);
  echo "While update affected $affected rows. <br>";


  /*
    Prepared statements & transactions
  */
  $dbh->beginTransaction();

  $sql = 'delete from user where id >= :id';
  $stmt = $dbh->prepare($sql);
  $id = 5;
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  $dbh->commit();

  echo "While prepared delete affected {$stmt->rowCount()} rows.";


  $sql = 'select user.name, post.caption from user inner join post where user.id = post.autor_id';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  // $results = $stmt->fetchAll();
  // // var_dump($results);
  // outputResult($results);
  echo "<pre>";
  while ($result = $stmt->fetch()) {
    var_dump($result);
  }
  echo "</pre>";


} catch (PDOException $e) {
  echo 'Failed! ' . $e->getMessage();
}