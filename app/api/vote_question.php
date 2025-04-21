<?php
// app/api/vote_question.php
header('Content-Type: application/json');
session_start();

// 0) Must be logged in
if (empty($_SESSION['username'])) {
  http_response_code(403);
  echo json_encode(['error'=>'Not logged in']);
  exit;
}

require_once __DIR__ . '/../db_connect.php';

if ($_SERVER['REQUEST_METHOD']!=='POST' || empty($_POST['id'])) {
  http_response_code(400);
  echo json_encode(['error'=>'Invalid request']);
  exit;
}

$uid = $conn->real_escape_string($_SESSION['username']);
$qid = (int)$_POST['id'];
$voted = false;

// 1) Have they already voted?
$stmt = $conn->prepare("SELECT 1 FROM question_votes WHERE question_id=? AND username=?");
$stmt->bind_param('is',$qid,$uid);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows) {
  // 2a) Already voted → remove it
  $voted = false;
  $del = $conn->prepare("DELETE FROM question_votes WHERE question_id=? AND username=?");
  $del->bind_param('is',$qid,$uid);
  $del->execute();
  $conn->query("UPDATE questions SET votes = votes - 1 WHERE id=$qid");
} else {
  // 2b) Not voted yet → add it
  $voted = true;
  $ins = $conn->prepare("INSERT INTO question_votes (question_id,username) VALUES (?,?)");
  $ins->bind_param('is',$qid,$uid);
  $ins->execute();
  $conn->query("UPDATE questions SET votes = votes + 1 WHERE id=$qid");
}

$stmt->close();

// 3) Fetch fresh vote count
$res = $conn->query("SELECT votes FROM questions WHERE id=$qid");
$row = $res->fetch_assoc();

echo json_encode([
  'success'=> true,
  'votes'  => (int)$row['votes'],
  'voted'  => $voted
]);
