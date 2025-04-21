<?php
// app/api/get_questions.php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/db_connect.php';

$filter = $_GET['filter'] ?? 'all';
$search = $_GET['search']  ?? '';

$where = [];
if ($filter === 'unanswered') {
    $where[] = "status='unanswered'";
} elseif ($filter === 'answered') {
    $where[] = "status='answered'";
}
if ($search !== '') {
    $safe = $conn->real_escape_string($search);
    $where[] = "(title LIKE '%{$safe}%' OR question_text LIKE '%{$safe}%')";
}
$where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$sql = "SELECT id, username, module, title, question_text, status, votes, created_at
        FROM questions
        $where_sql
        ORDER BY votes DESC, created_at DESC";
$res = $conn->query($sql);
if (!$res) {
    echo json_encode(['error'=>'DB error']);
    exit;
}

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = $r;
}
echo json_encode($rows);
