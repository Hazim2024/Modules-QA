<?php
session_start();

// Load users from the JSON file
$usersData = json_decode(file_get_contents("../js/users.json"), true);

// Get POST data
$username = $_POST['username'];
$password = $_POST['password'];

// Validate input and check credentials
foreach ($usersData['users'] as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
        $_SESSION['username'] = $username; // Store username in session
        $_SESSION['role'] = $user['role']; // Store role in session
        header("Location: ../main.php");
        exit;
    }
}

// If invalid credentials
header("Location: ../index.html?error=invalid");
?>
