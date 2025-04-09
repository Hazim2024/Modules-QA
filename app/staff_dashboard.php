<?php
session_start();

// Check if the user is logged in and is a staff
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    header("Location: ../index.html"); // Redirect to login if not logged in as staff
    exit;
}

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . " (Staff)!</h1>";
echo '<a href="logout.php">Logout</a>';
?>
