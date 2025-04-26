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

// 2) load banned words
$banned = [];
foreach (file(__DIR__ . '/../data/banned_words.txt', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $line) {
  $line = trim($line);
  if ($line === '' || $line[0] === '#') {
    continue;
  }
  $banned[] = preg_quote($line, '/');
}

// 3) check for banned words
$haystack = ($_POST['title'] ?? '') . "\n" . ($_POST['question'] ?? '');
$pattern = '/\b(' . implode('|', $banned) . ')\b/i';
if (preg_match($pattern, $haystack)) {
    $_SESSION['error'] = "Your question contains forbidden keywords.";
    header("Location: ../submit_question.php");
    exit;
}

// 4) insert into database
$stmt = $conn->prepare(
  "INSERT INTO questions (username,module,title,question_text)
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
$newQid = $conn->insert_id;
$stmt->close();

// 5) flash success + remember new id
$_SESSION['success']  = "Question submitted!";
$_SESSION['last_qid'] = $newQid;

// 6) redirect back
header("Location: ../submit_question.php");
exit;
