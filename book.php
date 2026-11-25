<?php
require_once __DIR__ . '/../includes/auth.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT b.*, g.name AS genre FROM books b JOIN genres g ON g.id = b.genre_id WHERE b.id = ?');
$stmt->execute([$id]);
$b = $stmt->fetch();

if (!$b) {
    http_response_code(404);
    $pageTitle = 'Табылмады';
    include __DIR__ . '/../includes/header.php';
    echo '<div class="card"><h1>Кітап табылмады</h1><p><a href="books.php">← Каталогқа қайту</a></p></div>';
    include __DIR__ . '/../includes/footer.php';
    exit;
}

$icons = ['📖', '📘', '📗', '📙', '📕'];
$pageTitle = $b['title'];
$active = 'books';
include __DIR__ . '/../includes/header.php';
?>
<p><a href="books.php">← Каталогқа қайту</a></p>
<div class="card detail">
  <div class="cover c<?= ($b['id'] % 4) + 1 ?>"><?= $icons[$b['id'] % 5] ?></div>
  <div>
    <h1><?= e($b['title']) ?></h1>
    <p><strong>Автор:</strong> <?= e($b['author']) ?></p>
    <p><strong>Жанр:</strong> <?= e($b['genre']) ?> · <strong>Жылы:</strong> <?= (int)$b['year'] ?></p>
    <p><strong>Даналар саны:</strong> <?= (int)$b['copies'] ?></p>
    <p><strong>Қосылған күні:</strong> <?= e(substr($b['created_at'], 0, 10)) ?></p>
    <p><?= nl2br(e($b['description'])) ?></p>

    <?php if (is_logged_in()): ?>
      <div class="btn-row" style="max-width:320px">
        <a class="btn btn-outline" href="book_edit.php?id=<?= (int)$b['id'] ?>">✏️ Өңдеу</a>
        <form method="post" action="book_delete.php" onsubmit="return confirm('Бұл кітапты жою керек пе?')" style="flex:1;display:flex">
          <input type="hidden" name="id" value="<?= (int)$b['id'] ?>">
          <button class="btn btn-danger" style="flex:1" type="submit">🗑 Жою</button>
        </form>
      </div>
    <?php else: ?>
      <p class="muted"><a href="login.php">Кіріңіз</a>, сонда кітапты өңдеуге немесе жоюға болады.</p>
    <?php endif; ?>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
