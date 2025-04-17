<?php
  // ensure session is available
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($pageTitle ?? 'Module Portal') ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script>
    function confirmLogout() {
      return confirm("Are you sure you want to log out?");
    }
  </script>
</head>
<body>
  <header>
    <h2 class="title">LJMU Module Q&A</h2>
    <nav class="navigation">
      <a href="main.php">Home</a>

      <?php if (isset($_SESSION['username'])): ?>
        <!-- student only -->
        <?php if ($_SESSION['role'] === 'student'): ?>
          <a href="submit_question.php">Submit Question</a>
        <?php endif; ?>

        <!-- everyone logged in -->
        <a href="app/logout.php"
           onclick="return confirmLogout();">
          Logout
        </a>
      <?php else: ?>
        <!-- not logged in -->
        <a href="app/login.php">Login</a>
      <?php endif; ?>
    </nav>
  </header>
