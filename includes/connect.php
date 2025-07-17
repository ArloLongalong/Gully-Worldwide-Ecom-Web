<?php

$con = mysqli_connect('localhost', 'root', '', 'gully');

if (!$con){
  die("Connection failed: " . mysqli_connect_error());
}

?>