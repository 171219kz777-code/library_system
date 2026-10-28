<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Тіркелу — Кітапхана</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container nav">
    <a class="logo" href="index.html"> Кітапхана</a>
    <button class="menu-btn" id="menuBtn" aria-label="Мәзір" aria-expanded="false">☰</button>
    <nav id="menu">
      <a href="index.html">Басты бет</a>
      <a href="books.html">Кітаптар</a>
      <a href="login.html">Кіру</a>
      <a href="register.html" class="btn-sm">Тіркелу</a>
    </nav>
  </div>
</header>
<main class="container">
<div class="card form-card">
  <h1>Тіркелу</h1>
  <form method="post" action="#" data-validate novalidate>
    <label>Аты-жөні
      <input type="text" name="name" required>
      <span class="field-error"></span>
    </label>
    <label>Email
      <input type="email" name="email" placeholder="name@mail.kz" required>
      <span class="field-error"></span>
    </label>
    <label>Пароль
      <span class="pw-wrap">
        <input type="password" name="password" required>
        <button type="button" class="pw-toggle">Көрсету</button>
      </span>
      <span class="hint">Кемінде 6 таңба</span>
      <span class="field-error"></span>
    </label>
    <label>Парольді қайталау
      <input type="password" name="password2" required>
      <span class="field-error"></span>
    </label>
    <button class="btn" type="submit">Тіркелу</button>
  </form>
  <p>Аккаунт бар ма? <a href="login.html">Кіру</a></p>
</div>
</main>
<footer class="site-footer"><div class="container">© 2026 Онлайн кітапхана жүйесі</div></footer>
<script src="../assets/js/main.js"></script>
</body>
</html>
