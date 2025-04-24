<!DOCTYPE html>
<html>
<body>
<?php 
$pageTitle = "Home Page"; // Set a dynamic page title
include('header.php'); ?>

<main>

    <div class="container-fluid">
        
        <?php if (!empty($_SESSION['username'])): ?>
        <h1>
            Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!
        </h1>
        <?php endif; ?>
        
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
        <p class="label-1">This is the main content of the home page.</p>
    </div>
</main>

<?php include('footer.php'); ?>
</body>
</html>
<script src="js/script.js"></script>