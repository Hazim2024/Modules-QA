<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: ../index.html");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$pageTitle = "Student Dashboard";
include('header.php');
?>

<main>
    <div class="container">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>Explore your dashboard features below:</p>
        <a href="../submit_question.php">Submit Questions</a>
        <a href="logout.php" onclick="return confirmLogout();">Logout</a>
    </div>
</main>

<script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
</script>

<?php include('footer.php'); ?>
