<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: ../index.html"); // Redirect to login if not logged in as a student
    exit;
}

$username = $_SESSION['username']; // Get the logged-in username
?>
<?php include('header.php'); ?>
<?php if (isset($_SESSION['username'])): ?>
    <p class="label-1">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Question</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <div class="form-container">
        <h1>Submit a Question</h1>
        <form action="app/submit_question.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

            <label for="module">Module:</label>
            <select id="module" name="module" required>
                <option value="Math">Math</option>
                <option value="Science">Science</option>
                <option value="History">History</option>
            </select>

            <label for="title">Question Title:</label>
            <input type="text" id="title" name="title" maxlength="100" required>

            <label for="question">Your Question:</label>
            <textarea id="question" name="question" rows="5" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
<?php include('footer.php'); ?>

</html>
