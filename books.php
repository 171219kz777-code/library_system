<?php
$pageTitle = 'Кітаптар';
$active = 'books';
include __DIR__ . '/../includes/header.php';

$q     = trim($_GET['q'] ?? '');
$genre = $_GET['genre'] ?? '';
$sort  = $_GET['sort'] ?? 'title';
if (!in_array($genre, $genres, true)) $genre = '';            
if (!in_array($sort, ['title', 'author', 'year'], true)) $sort = 'title';
if (mb_strlen($q) > 100) $q = mb_substr($q, 0, 100);

$result = array_filter($books, function ($b) use ($q, $genre) {
    if ($genre !== '' && $b['genre'] !== $genre) return false;
    if ($q !== '' && mb_stripos($b['title'] . ' ' . $b['author'], $q) === false) return false;
    return true;
});

uasort($result, function ($a, $b) use ($sort) {
    return $sort === 'year' ? $b['year'] <=> $a['year'] : strcmp($a[$sort], $b[$sort]);
});
?>
<h1>Кітаптар каталогы</h1>
<form method="get" action="books.php" class="filters">
  <input type="search" name="q" value="<?= e($q) ?>" placeholder="Кітап атауы немесе авторы" aria-label="Іздеу">
  <select name="genre" aria-label="Жанр">
    <option value="">Барлық жанр</option>
    <?php foreach ($genres as $g): ?>
      <option value="<?= e($g) ?>" <?= $genre === $g ? 'selected' : '' ?>><?= e($g) ?></option>
    <?php endforeach; ?>
  </select>
  <select name="sort" aria-label="Сұрыптау">
    <option value="title"  <?= $sort==='title'  ? 'selected' : '' ?>>Атауы бойынша</option>
    <option value="author" <?= $sort==='author' ? 'selected' : '' ?>>Авторы бойынша</option>
    <option value="year"   <?= $sort==='year'   ? 'selected' : '' ?>>Жылы бойынша (жаңасы)</option>
  </select>
  <button class="btn" type="submit">🔎 Іздеу</button>
  <a class="btn btn-light" href="books.php">Тазалау</a>
</form>
<p class="muted">Табылды: <?= count($result) ?></p>
<?php if (!$result): ?>
  <div class="card" style="text-align:center;padding:30px">Ештеңе табылмады </div>
<?php endif; ?>
<div class="grid">
<?php foreach ($result as $id => $b) echo book_card($id, $b); ?>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
