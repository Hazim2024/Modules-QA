<?php
session_start();

// Check if the user is logged in and is a student
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("/index.html"); // Redirect to login if not logged in as a student
    exit;
}

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . " (Student)!</h1>";
echo '<a href="logout.php">Logout</a>';
?>
