<?php
session_start();
session_destroy(); // Destroy all session data
header("Location: ../main.php"); // Redirect to login page
?>
