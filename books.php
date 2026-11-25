<?php
require_once __DIR__ . '/../includes/auth.php';

$q        = trim($_GET['q'] ?? '');
$genre_id = (int)($_GET['genre'] ?? 0);
$year_from = (int)($_GET['year_from'] ?? 0);
$year_to   = (int)($_GET['year_to'] ?? 0);
$sort     = $_GET['sort'] ?? 'new';
$dir      = $_GET['dir'] ?? 'desc';
$page     = max(1, (int)($_GET['page'] ?? 1));
$perPage  = 6;                                  

if (mb_strlen($q) > 100) $q = mb_substr($q, 0, 100);

$sortColumns = [
    'new'    => 'b.created_at',
    'title'  => 'b.title',
    'author' => 'b.author',
    'year'   => 'b.year',
];
if (!isset($sortColumns[$sort])) $sort = 'new';
$dir = ($dir === 'asc') ? 'ASC' : 'DESC';

$where = [];
$params = [];

if ($q !== '') {                                  
    $where[] = '(b.title LIKE ? OR b.author LIKE ?)';
    $params[] = "%$q%";
    $params[] = "%$q%";
}
if ($genre_id > 0) {                              
    $where[] = 'b.genre_id = ?';
    $params[] = $genre_id;
}
if ($year_from > 0) {                            
    $where[] = 'b.year >= ?';
    $params[] = $year_from;
}
if ($year_to > 0) {                               
    $where[] = 'b.year <= ?';
    $params[] = $year_to;
}
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$stmt = $pdo->prepare("SELECT COUNT(*) FROM books b $whereSql");
$stmt->execute($params);
$total = (int)$stmt->fetchColumn();
$pages = max(1, (int)ceil($total / $perPage));
$page = min($page, $pages);
$offset = ($page - 1) * $perPage;

$orderBy = $sortColumns[$sort] . ' ' . $dir;
$sql = "SELECT b.*, g.name AS genre
        FROM books b JOIN genres g ON g.id = b.genre_id
        $whereSql
        ORDER BY $orderBy, b.id DESC
        LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$books = $stmt->fetchAll();

$genres = get_genres($pdo);

$pageTitle = 'Кітаптар';
$active = 'books';
include __DIR__ . '/../includes/header.php';
?>
<div class="section-title">
  <h1 style="margin:0">Кітаптар каталогы</h1>
  <?php if (is_logged_in()): ?><a class="btn" href="book_add.php">+ Кітап қосу</a><?php endif; ?>
</div>

<form method="get" action="books.php" class="filters">
  <input type="search" name="q" value="<?= e($q) ?>" placeholder="Атауы немесе авторы" aria-label="Іздеу" class="f-wide">
  <select name="genre" aria-label="Жанр">
    <option value="0">Барлық жанр</option>
    <?php foreach ($genres as $g): ?>
      <option value="<?= (int)$g['id'] ?>" <?= $genre_id === (int)$g['id'] ? 'selected' : '' ?>><?= e($g['name']) ?></option>
    <?php endforeach; ?>
  </select>
  <select name="sort" aria-label="Сұрыптау">
    <option value="new"    <?= $sort==='new'    ? 'selected' : '' ?>>Қосылған күні</option>
    <option value="title"  <?= $sort==='title'  ? 'selected' : '' ?>>Атауы</option>
    <option value="author" <?= $sort==='author' ? 'selected' : '' ?>>Авторы</option>
    <option value="year"   <?= $sort==='year'   ? 'selected' : '' ?>>Шыққан жылы</option>
  </select>
  <input type="number" name="year_from" value="<?= $year_from ?: '' ?>" placeholder="Жылдан" aria-label="Жылдан">
  <input type="number" name="year_to" value="<?= $year_to ?: '' ?>" placeholder="Жылға дейін" aria-label="Жылға дейін">
  <select name="dir" aria-label="Бағыты">
    <option value="desc" <?= $dir==='DESC' ? 'selected' : '' ?>>Кему ↓</option>
    <option value="asc"  <?= $dir==='ASC'  ? 'selected' : '' ?>>Өсу ↑</option>
  </select>
  <div class="filter-btns">
    <button class="btn" type="submit">🔎 Іздеу</button>
    <a class="btn btn-light" href="books.php">Тазалау</a>
  </div>
</form>

<p class="muted">Табылды: <?= $total ?> · Бет <?= $page ?> / <?= $pages ?></p>

<?php if (!$books): ?>
  <div class="card" style="text-align:center;padding:30px">Ештеңе табылмады 😕</div>
<?php endif; ?>

<div class="grid">
<?php foreach ($books as $b) echo book_card($b); ?>
</div>

<?= pagination($page, $pages) ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>
