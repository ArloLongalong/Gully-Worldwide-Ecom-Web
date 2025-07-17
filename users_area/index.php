<?php
// Connect to the database
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

// Check if user is logged in
if(!isset($_SESSION['username'])){
    // If not logged in, redirect to login page
    header("Location: user_login.php");
    exit();
} else {
    // If logged in, redirect to profile page
    header("Location: profile.php");
    exit();
}
?>
