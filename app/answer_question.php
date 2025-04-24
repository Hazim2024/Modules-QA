<?php
// app/answer_question.php
session_start();
header('Content-Type: text/html; charset=utf-8');

// 1) staff‐only guard
if (empty($_SESSION['username']) || $_SESSION['role']!=='staff') {
  header('Location: ../main.php');
  exit;
}

require_once __DIR__ . '/db_connect.php';

// 2) simple request validation
if ($_SERVER['REQUEST_METHOD']!=='POST'
    || empty($_POST['question_id'])
    || empty(trim($_POST['answer_text']))) {
  $_SESSION['error'] = "Please provide an answer.";
  header("Location: ../answer_question.php?id=".((int)$_POST['question_id']));
  exit;
}

$qid  = (int)$_POST['question_id'];
$ans  = trim($_POST['answer_text']);
$user = $_SESSION['username'];

// 3) insert into answers
$stmt = $conn->prepare(
  "INSERT INTO answers (question_id, username, answer_text)
   VALUES (?, ?, ?)"
);
$stmt->bind_param('iss', $qid, $user, $ans);
$stmt->execute();
$stmt->close();

// 4) mark question answered
$upd = $conn->prepare(
  "UPDATE questions SET status='answered' WHERE id=?"
);
$upd->bind_param('i', $qid);
$upd->execute();
$upd->close();

// 5) feedback + redirect back to view
header("Location: ../answer_question.php?id=" . $qid);
exit;
