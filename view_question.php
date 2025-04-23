<?php
session_start();
require_once __DIR__ . '/app/db_connect.php';

// 1) Filter logic
$filter = $_GET['filter'] ?? 'all';
$where  = '';
if ($filter === 'unanswered') {
    $where = "WHERE status = 'unanswered'";
} elseif ($filter === 'answered') {
    $where = "WHERE status = 'answered'";
}

// 2) Fetch
$sql="SELECT * FROM questions
           $where
           ORDER BY votes DESC, created_at DESC";
$result = $conn->query($sql);
if (!$result) {
    die("DB Error: " . $conn->error);
}

// 3) Show page
$pageTitle = "All Questions";
include 'header.php';
?>

<main>
  <div class="questions-container">
    <!-- ——— LIVE SEARCH ——— -->
    <div class="mb-4 text-center">
      <input type="text" id="search-input" placeholder="Search questions…" class="form-control w-50 d-inline-block">
    </div>

    <!-- ——— FILTER PILLS ——— -->
    <ul class="filter-pills">
      <?php foreach (['all'=>'All','unanswered'=>'Unanswered','answered'=>'Answered'] as $key=>$lab): ?>
        <li class="filter-pill">
          <a
            href="?filter=<?= $key ?>"
            class="filter-link <?= $filter === $key ? 'active' : '' ?>"
            data-filter="<?= $key ?>">
            <?= htmlspecialchars($lab) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <!-- ——— QUESTIONS GRID ——— -->
    <div id="questions-grid" class="questions-grid">
      <?php while ($q = $result->fetch_assoc()): ?>
        <div class="question-column">
          <div class="question-card">

            <div class="question-card-header">
              <span class="module-badge"><?= htmlspecialchars($q['module']) ?></span>
              <span class="status-badge <?= $q['status'] === 'unanswered' ? 'unanswered' : 'answered' ?>">
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
              <button
                class="vote-button<?= isset($hasVoted) && $hasVoted ? ' voted' : '' ?>"
                data-id="<?= (int)$q['id'] ?>">
                ▲ <?= (int)$q['votes'] ?>
              </button>

              <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'staff' && $q['status'] === 'unanswered'): ?>
                <a href="answer_question.php?id=<?= (int)$q['id'] ?>"
                   class="answer-button">Answer</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<!-- Your consolidated script -->
<script src="js/script.js"></script>
