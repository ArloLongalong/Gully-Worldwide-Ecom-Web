<?php

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_NAME') ?: 'gullydb';

$con = mysqli_connect($host, $user, $password, $database);

if (!$con){
  die("Connection failed: " . mysqli_connect_error());
}

?>