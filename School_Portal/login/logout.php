<?php
session_start(); // Initialize session
session_destroy(); // Destroy all data associated with the current session
header("location: index.php"); // Redirect to the login page
?>
