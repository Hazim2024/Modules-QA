<?php
session_start();

// Load users from the JSON file
$users = json_decode(file_get_contents("../data/users.json"), true);

// Get POST data
$username = $_POST['username'];
$password = $_POST['password'];

// Validate input
foreach ($users as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
        $_SESSION['username'] = $username; // Store user in session
        header("Location: dashboard.php"); // Redirect to dashboard
        exit;
    }
}

// If invalid credentials
echo "Invalid username or password.";
?>
