<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$login = 'admin';
$password = 'qwerty';

$form = <<<EOT
<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
<input name="filedata" type="file" /> <br>
<input type="submit" value="Upload" />
</form>
EOT;


if ($_SERVER['PHP_AUTH_USER'] === $login && $_SERVER['PHP_AUTH_PW'] === $password) {
  echo $form;

} else {

  header('WWW-Authenticate: Basic realm="test"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'Необходима аутентификациия';
  exit;
}
?>