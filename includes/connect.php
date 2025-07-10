<?php

$con = mysqli_connect('localhost', 'root', '', 'gullyappdb');

if (!$con){
  die("Connection failed: " . mysqli_connect_error());
}

?>