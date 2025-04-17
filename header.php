<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Default Title'; ?></title> <!-- Dynamically set the page title -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="wallet.svg">
</head>
<body>
    <header>
        <h2 class="title">LJMU Module Q&A</h2>
        <nav class="navigation">
            <a href="main.php">Home</a>
            <a href="#" id="Modules-link">Module Selection</a>
            <a href="submit_question.php" id="Submit-link">Submit Question</a>
            <a href="#" id="View-link">View Questions</a>
            <a href="index.html" id="Login-link">Login</a>
        </nav>
    </header>
