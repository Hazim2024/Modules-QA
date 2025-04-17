<?php
session_start();

// Load your users
$usersData = json_decode(file_get_contents(__DIR__ . "/../js/users.json"), true);

// Prepare an error message container
$error = '';

// If the form was submitted, handle authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $found = false;
    foreach ($usersData['users'] as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            // Success!
            $_SESSION['username'] = $username;
            $_SESSION['role']     = $user['role'];
            header("Location: ../main.php");
            exit;
        }
    }

    // If we get here, login failed
    $error = '⚠️ Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <link rel="stylesheet" href="../css/style.css">  <!-- adjust path as needed -->
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>

    <!-- Show error if any -->
    <?php if ($error): ?>
      <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
        <button type="button" onclick="window.location.href='../main.php'">Home</button>
    </form>
  </div>
</body>
</html>
