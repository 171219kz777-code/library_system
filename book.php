<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Кітаптар — Кітапхана</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container nav">
    <a class="logo" href="index.html"> Кітапхана</a>
    <button class="menu-btn" id="menuBtn" aria-label="Мәзір" aria-expanded="false">☰</button>
    <nav id="menu">
      <a href="index.html">Басты бет</a>
      <a href="books.html" class="active">Кітаптар</a>
      <a href="login.html">Кіру</a>
      <a href="register.html" class="btn-sm">Тіркелу</a>
    </nav>
  </div>
</header>
<main class="container">
<h1>Кітаптар каталогы</h1>
<div class="filters">
  <input type="search" id="q" placeholder="Атауы немесе авторы" aria-label="Іздеу">
  <select id="genre" aria-label="Жанр">
    <option value="">Барлық жанр</option>
    <option>Роман</option><option>Тарих</option><option>Ғылыми</option>
    <option>Балаларға</option><option>Бағдарламалау</option>
  </select>
  <select id="sort" aria-label="Сұрыптау">
    <option value="title">Атауы бойынша</option>
    <option value="author">Авторы бойынша</option>
    <option value="year">Жылы бойынша (жаңасы)</option>
  </select>
  <button class="btn btn-light" id="reset" type="button">Тазалау</button>
</div>
<p class="muted">Табылды: <span id="count">0</span></p>
<div class="card empty" id="empty">Ештеңе табылмады.</div>
<div class="grid" id="bookList">
    <a class="card book" href="#" data-title="Абай жолы" data-author="Мұхтар Әуезов" data-genre="Роман" data-year="1942">
      <div class="cover"></div>
      <h3>Абай жолы</h3>
      <p>Мұхтар Әуезов, 1942</p>
      <span class="tag">Роман</span> <span class="tag free">Бос</span>
    </a>
    <a class="card book" href="#" data-title="Көшпенділер" data-author="Ілияс Есенберлин" data-genre="Тарих" data-year="1976">
      <div class="cover"></div>
      <h3>Көшпенділер</h3>
      <p>Ілияс Есенберлин, 1976</p>
      <span class="tag">Тарих</span> <span class="tag free">Бос</span>
    </a>
    <a class="card book" href="#" data-title="Қан мен тер" data-author="Әбдіжәміл Нұрпейісов" data-genre="Роман" data-year="1970">
      <div class="cover"></div>
      <h3>Қан мен тер</h3>
      <p>Әбдіжәміл Нұрпейісов, 1970</p>
      <span class="tag">Роман</span> <span class="tag busy">Бос емес</span>
    </a>
    <a class="card book" href="#" data-title="Ұйқыдағы қыз" data-author="Ғабит Мүсірепов" data-genre="Роман" data-year="1957">
      <div class="cover"></div>
      <h3>Ұйқыдағы қыз</h3>
      <p>Ғабит Мүсірепов, 1957</p>
      <span class="tag">Роман</span> <span class="tag free">Бос</span>
    </a>
    <a class="card book" href="#" data-title="PHP және MySQL" data-author="Лук Веллинг" data-genre="Бағдарламалау" data-year="2015">
      <div class="cover"></div>
      <h3>PHP және MySQL</h3>
      <p>Лук Веллинг, 2015</p>
      <span class="tag">Бағдарламалау</span> <span class="tag free">Бос</span>
    </a>
    <a class="card book" href="#" data-title="Алгоритмдер" data-author="Т. Кормен" data-genre="Ғылыми" data-year="2009">
      <div class="cover"></div>
      <h3>Алгоритмдер</h3>
      <p>Т. Кормен, 2009</p>
      <span class="tag">Ғылыми</span> <span class="tag free">Бос</span>
    </a>
    <a class="card book" href="#" data-title="Қазақ халқының ертегілері" data-author="Халық ауыз әдебиеті" data-genre="Балаларға" data-year="1990">
      <div class="cover"></div>
      <h3>Қазақ халқының ертегілері</h3>
      <p>Халық ауыз әдебиеті, 1990</p>
      <span class="tag">Балаларға</span> <span class="tag free">Бос</span>
    </a>
    <a class="card book" href="#" data-title="Қазақ хандығының тарихы" data-author="Б. Кәрібаев" data-genre="Тарих" data-year="2011">
      <div class="cover"></div>
      <h3>Қазақ хандығының тарихы</h3>
      <p>Б. Кәрібаев, 2011</p>
      <span class="tag">Тарих</span> <span class="tag free">Бос</span>
    </a>
</div>
<div class="pagination">
  <a href="#" class="active">1</a><a href="#">2</a><a href="#">3</a>
</div>
</main>
<footer class="site-footer"><div class="container">© 2026 Онлайн кітапхана жүйесі</div></footer>
<script src="../assets/js/main.js"></script>
</body>
</html>
