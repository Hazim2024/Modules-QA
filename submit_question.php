<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: ../index.html"); // Redirect to login if not logged in as a student
    exit;
}

$username = $_SESSION['username']; // Get the logged-in username
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Question</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional CSS -->
</head>
<body>
    <h1>Submit a Question</h1>
    <form action="app/submit_question.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly><br><br>

        <label for="module">Module:</label>
        <select id="module" name="module" required>
            <option value="Math">Math</option>
            <option value="Science">Science</option>
            <option value="History">History</option>
        </select><br><br>

        <label for="title">Question Title:</label>
        <input type="text" id="title" name="title" maxlength="100" required><br><br>

        <label for="question">Your Question:</label><br>
        <textarea id="question" name="question" rows="5" cols="40" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
