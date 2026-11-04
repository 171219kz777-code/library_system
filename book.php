<?php
$pageTitle = 'Кітап';
$active = 'books';
include __DIR__ . '/../includes/header.php';

$id = (int)($_GET['id'] ?? 0);          
$b = $books[$id] ?? null;
if (!$b) {
    http_response_code(404);
    echo '<div class="card"><h1>Кітап табылмады</h1><p><a href="books.php">← Каталогқа қайту</a></p></div>';
    include __DIR__ . '/../includes/footer.php';
    exit;
}
?>
<p><a href="books.php">← Каталогқа қайту</a></p>
<div class="card detail">
  <div class="cover <?= e($b['color']) ?>"><?= e($b['icon']) ?></div>
  <div>
    <h1><?= e($b['title']) ?></h1>
    <p><strong>Автор:</strong> <?= e($b['author']) ?></p>
    <p><strong>Жанр:</strong> <?= e($b['genre']) ?> · <strong>Жылы:</strong> <?= (int)$b['year'] ?></p>
    <p><span class="tag <?= $b['free'] ? 'free' : 'busy' ?>"><?= $b['free'] ? 'Бос' : 'Бос емес' ?></span></p>
    <p><?= e($b['description']) ?></p>
    <a class="btn" href="login.php">Қарызға алу</a>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>

