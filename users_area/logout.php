<?php

session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
echo "<script>window.open('../index.php', '_self')</script>"; // Redirect to the homepage

?>