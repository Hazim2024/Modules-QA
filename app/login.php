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

        // Redirect based on the role
        if ($user['role'] === 'student') {
            header("Location: student_dashboard.php"); // Redirect to student dashboard
        } elseif ($user['role'] === 'staff') {
            header("Location: staff_dashboard.php"); // Redirect to staff dashboard
        }
        exit;
    }
}

// If invalid credentials
echo "Invalid username or password.";
?>
