<?php
session_start();

// 1) DB connection
require_once __DIR__ . '/app/db_connect.php';

// 2) Filter logic
$filter = $_GET['filter'] ?? 'all';
$where  = '';
if ($filter === 'unanswered') {
    $where = "WHERE status = 'unanswered'";
} elseif ($filter === 'answered') {
    $where = "WHERE status = 'answered'";
}

// 3) Fetch
$sql = "SELECT * FROM questions
        $where
        ORDER BY votes DESC, created_at DESC";
$result = $conn->query($sql);
if (!$result) {
    die("DB Error: " . $conn->error);
}

// 4) Show page
$pageTitle = "All Questions";
include 'header.php';
?>
<main>
  <div class="questions-container">
    <!-- Filter Pills -->
    <ul class="filter-pills">
      <?php foreach (['all'=>'All','unanswered'=>'Unanswered','answered'=>'Answered'] as $key => $label): ?>
        <li class="filter-pill">
          <a href="?filter=<?= $key ?>"
             class="filter-link<?= $filter=== $key ? ' active' : '' ?>">
            <?= htmlspecialchars($label) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <!-- Questions Grid -->
    <div class="questions-grid">
      <?php while ($q = $result->fetch_assoc()): ?>
        <div class="question-column">
          <div class="question-card">
            <div class="question-card-header">
              <span class="module-badge"><?= htmlspecialchars($q['module']) ?></span>
              <span class="status-badge <?= $q['status']==='unanswered'? 'unanswered':'answered' ?>">
                <?= ucfirst(htmlspecialchars($q['status'])) ?>
              </span>
            </div>
            <div class="question-card-body">
              <h2 class="question-title"><?= htmlspecialchars($q['title']) ?></h2>
              <p class="question-text"><?= nl2br(htmlspecialchars($q['question_text'])) ?></p>
              <small class="question-meta">
                Asked by <?= htmlspecialchars($q['username']) ?>
                on <?= htmlspecialchars($q['created_at']) ?>
              </small>
            </div>
            <div class="question-card-footer">
              <form action="app/vote_question.php" method="POST">
                <input type="hidden" name="id" value="<?= (int)$q['id'] ?>">
                <button class="vote-button" type="submit">
                  ▲ <?= (int)$q['votes'] ?>
                </button>
              </form>
              <?php if (!empty($_SESSION['role']) && $_SESSION['role']==='staff' && $q['status']==='unanswered'): ?>
                <a href="answer_question.php?id=<?= (int)$q['id'] ?>"
                   class="answer-button">
                  Answer
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</main>
<?php include 'footer.php'; ?>
