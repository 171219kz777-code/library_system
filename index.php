<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Басты бет — Кітапхана</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container nav">
    <a class="logo" href="index.html"> Кітапхана</a>
    <button class="menu-btn" id="menuBtn" aria-label="Мәзір" aria-expanded="false">☰</button>
    <nav id="menu">
      <a href="index.html" class="active">Басты бет</a>
      <a href="books.html">Кітаптар</a>
      <a href="login.html">Кіру</a>
      <a href="register.html" class="btn-sm">Тіркелу</a>
    </nav>
  </div>
</header>
<main class="container">
<section class="hero">
  <h1>Онлайн кітапхана</h1>
  <p>Кітаптарды іздеп, қарызға ал — үйден шықпай-ақ.</p>
  <form action="books.html" method="get" class="hero-search">
    <input type="search" name="q" placeholder="Кітап атауы немесе авторы..." aria-label="Іздеу">
    <button class="btn" type="submit">Іздеу</button>
  </form>
</section>

<section class="features">
  <div class="card feature"><div class="ico"></div><h3>Жылдам іздеу</h3><p>Атауы, авторы және жанр бойынша тап.</p></div>
  <div class="card feature"><div class="ico"></div><h3>Онлайн қарыз</h3><p>Кітапты 14 күнге алып, мерзімін бақыла.</p></div>
  <div class="card feature"><div class="ico"></div><h3>Жеке кабинет</h3><p>Өз қарыздарың мен профиліңді басқар.</p></div>
</section>

<h2>Жаңа кітаптар</h2>
<div class="grid">
    <a class="card book" href="books.html">
      <div class="cover"></div><h3>Абай жолы</h3><p>Мұхтар Әуезов</p><span class="tag">Роман</span>
    </a>
    <a class="card book" href="books.html">
      <div class="cover"></div><h3>Көшпенділер</h3><p>Ілияс Есенберлин</p><span class="tag">Тарих</span>
    </a>
    <a class="card book" href="books.html">
      <div class="cover"></div><h3>Қан мен тер</h3><p>Әбдіжәміл Нұрпейісов</p><span class="tag">Роман</span>
    </a>
    <a class="card book" href="books.html">
      <div class="cover"></div><h3>Ұйқыдағы қыз</h3><p>Ғабит Мүсірепов</p><span class="tag">Роман</span>
    </a>
</div>
<p style="text-align:center;margin-top:24px"><a class="btn" href="books.html">Барлық кітаптар</a></p>
</main>
<footer class="site-footer"><div class="container">© 2026 Онлайн кітапхана жүйесі</div></footer>
<script src="../assets/js/main.js"></script>
</body>
</html>
