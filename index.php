<?php
$pageTitle = 'Басты бет';
$active = 'index';
include __DIR__ . '/../includes/header.php';
?>
<section class="hero">
  <h1>📚 Онлайн кітапхана</h1>
  <p>Кітаптарды іздеп, қарызға ал — үйден шықпай-ақ.</p>
  <form action="books.php" method="get" class="hero-search">
    <input type="search" name="q" placeholder="Кітап атауы немесе авторы..." aria-label="Іздеу">
    <button class="btn" type="submit">🔎 Іздеу</button>
  </form>
</section>

<section class="stats">
  <div class="card"><b><?= count($books) ?></b><span>Кітап</span></div>
  <div class="card"><b>120</b><span>Оқырман</span></div>
  <div class="card"><b><?= count($genres) ?></b><span>Жанр</span></div>
</section>

<section class="features">
  <div class="card feature"><div class="ico">🔎</div><h3>Жылдам іздеу</h3><p>Атауы, авторы және жанр бойынша тап.</p></div>
  <div class="card feature"><div class="ico">📥</div><h3>Онлайн қарыз</h3><p>Кітапты 14 күнге алып, мерзімін бақыла.</p></div>
  <div class="card feature"><div class="ico">👤</div><h3>Жеке кабинет</h3><p>Өз қарыздарың мен профиліңді басқар.</p></div>
</section>

<div class="section-title"><h2>Жаңа кітаптар</h2><a href="books.php">Барлығын көру →</a></div>
<div class="grid">
<?php foreach (array_slice($books, 0, 4, true) as $id => $b) echo book_card($id, $b); ?>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
