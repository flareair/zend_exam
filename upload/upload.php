<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

// var_dump($_FILES['filedata']);

function checkUploadedImage($arr) {
  if (!is_uploaded_file($arr['filedata']['tmp_name']) || $arr['filedata']['error'] !== UPLOAD_ERR_OK || $arr['filedata']['tmp_name'] === 'none') {
    throw new Exception("Error uploading file", 1);
  }
  if ($arr['filedata']['type'] !== 'image/jpeg') {
    throw new Exception("Only jpeg images allowed", 1);
  }
  if ($arr['filedata']['size'] > 1000000) {
    throw new Exception("File is to large", 1);
  }
  if ($arr['filedata']['size'] === 0) {
    throw new Exception("File is empty", 1);
  }
  return true;
}


function generateRandomFileName() {
  return uniqid('img_') . '.jpeg';
}


$uploadDir = '/var/www/test/upload/files/';

try {
  $uploadOk = checkUploadedImage($_FILES);
} catch (Exception $e) {
  echo $e->getMessage();
  $uploadOk = false;
}

if ($uploadOk) {
  $filename = generateRandomFileName();
  $uploadedFilePath = $uploadDir . $filename;
  move_uploaded_file($_FILES['filedata']['tmp_name'], $uploadedFilePath);
  echo 'Image uploaded!';
  echo "<img src='files/$filename' alt=''>";
}