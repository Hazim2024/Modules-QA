<?php
// app/submit_question.php
session_start();
require_once __DIR__ . '/db_connect.php';

// 1) student-only guard
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    $_SESSION['error'] = "You must be logged in as a student to post.";
    header("Location: ../submit_question.php");
    exit;
}

try {
    // 2) prepare & execute insert
    $stmt = $conn->prepare(
      "INSERT INTO questions (username, module, title, question_text)
       VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param(
      'ssss',
      $_SESSION['username'],
      $_POST['module'],
      $_POST['title'],
      $_POST['question']
    );
    $stmt->execute();

    // 3) grab the auto‐increment ID of the row we just inserted
    $newQid = $conn->insert_id;

    $stmt->close();

    // 4) set flash and last_qid
    $_SESSION['success']  = "Question submitted!";
    $_SESSION['last_qid'] = $newQid;

    // 5) redirect back to the form page
    header("Location: ../submit_question.php");
    exit;
} catch (Exception $e) {
    // on error, flash an error and go back
    $_SESSION['error'] = "There was an error submitting your question. Please try again.";
    header("Location: ../submit_question.php");
    exit;
}
