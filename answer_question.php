<?php
session_start();
// staff‐only guard
if (empty($_SESSION['username']) || $_SESSION['role']!=='staff') {
  header('Location: main.php');
  exit;
}

require_once __DIR__ . '/app/db_connect.php';

// 1) get question id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
  die("Invalid question ID");
}

// 2) fetch question
$stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$q = $stmt->get_result()->fetch_assoc();
if (!$q) {
  die("Question not found");
}
$stmt->close();

$pageTitle = "Answer: " . htmlspecialchars($q['title']);
include 'header.php';
?>

<main>
  <div class="container form-container">
    <h1>Answer Question</h1>

    <div class="card mb-4">
      <div class="card-header custom-header">
        <strong><?= htmlspecialchars($q['module']) ?></strong>
        <span class="badge badge-<?= $q['status']==='unanswered' ? 'warning' : 'success' ?>">
          <?= ucfirst($q['status']) ?>
        </span>
      </div>
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($q['title']) ?></h5>
        <p><?= nl2br(htmlspecialchars($q['question_text'])) ?></p>
        <small class="text-muted">
          Asked by <?= htmlspecialchars($q['username']) ?>
          on <?= htmlspecialchars($q['created_at']) ?>
        </small>
      </div>
    </div>

    <form action="app/answer_question.php" method="POST">
      <input type="hidden" name="question_id" value="<?= $id ?>">
      <div class="form-group">
        <label for="answer_text">Your Answer</label>
        <textarea
          id="answer_text"
          name="answer_text"
          class="form-control"
          rows="6"
          required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Post Answer</button>
      <a href="view_question.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</main>

<?php include 'footer.php'; ?>
