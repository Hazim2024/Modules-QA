<?php
session_start();


// Check login status and roles
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] !== 'student') {
        // User is logged in but not a student
        $error = "You need to be a student to use this feature.";
    }
} else {
    // User is not logged in
    $error = "You need to log in as a student to use this feature.";
}
?>


<?php include('header.php'); ?>


<main>
    <div class="form-container">
        <h1>Submit a Question</h1>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <div class="button-container">
                <a href="app/login.php" class="button">Go to Login</a>
                <button onclick="history.back()" class="button back-button">Back</button>
            </div>
        <?php else: ?>
            <form action="app/submit_question.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>

                <label for="module">Module:</label>
                <select id="module" name="module" required>
                    <option value="Math">Math</option>
                    <option value="Science">Science</option>
                    <option value="History">History</option>
                </select>

                <label for="title">Question Title:</label>
                <input type="text" id="title" name="title" placeholder="Short title: e.g. ‘Trouble reading JSON file in PHP'" maxlength="100" required>

                <label for="question">Your Question:</label>
                <textarea id="question" name="question" rows="5" placeholder="Explain your problem step by step so staff can help you best  " required></textarea>

                <button type="submit">Submit</button>
            </form>
        <?php endif; ?>
    </div>
        </main>
<?php include('footer.php'); ?>
<script src="js/script.js"></script>
