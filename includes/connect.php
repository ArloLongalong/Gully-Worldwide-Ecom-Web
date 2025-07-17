<?php

$con = mysqli_connect('localhost', 'root', '', 'gullydb');

if (!$con){
  die("Connection failed: " . mysqli_connect_error());
}

?>