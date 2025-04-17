<?php
session_start();

// 1) require the DB connection from the same folder:
require_once __DIR__ . '/db_connect.php';

// 2) student‐only guard
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    $_SESSION['error'] = "You must be logged in as a student to post.";
    header("Location: ../submit_question.php");
    exit;
}

// 3) collect POST, filter banned words, then:
$stmt = $conn->prepare(
  "INSERT INTO questions (username,module,title,question_text)
   VALUES (?,?,?,?)"
);
$stmt->bind_param('ssss',
    $_SESSION['username'],
    $_POST['module'],
    $_POST['title'],
    $_POST['question']
);
$stmt->execute();
$stmt->close();

$_SESSION['success'] = "Question submitted!";
header("Location: ../submit_question.php");
exit;
