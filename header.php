<?php
require_once __DIR__ . '/auth.php';          
require_once __DIR__ . '/../config/data.php'; 
$pageTitle = $pageTitle ?? 'Кітапхана';
$active = $active ?? '';
?>
<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> — Кітапхана</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container nav">
    <a class="logo" href="index.php"> Кітапхана</a>
    <button class="menu-btn" id="menuBtn" aria-label="Мәзір" aria-expanded="false">☰</button>
    <nav id="menu">
      <a href="index.php"<?= $active==='index' ? ' class="active"' : '' ?>>Басты бет</a>
      <a href="books.php"<?= $active==='books' ? ' class="active"' : '' ?>>Кітаптар</a>
      <?php if (is_logged_in()): ?>
        <a href="profile.php"<?= $active==='profile' ? ' class="active"' : '' ?>>👤 <?= e($_SESSION['user_name']) ?></a>
        <a href="logout.php" class="btn-sm">Шығу</a>
      <?php else: ?>
        <a href="login.php"<?= $active==='login' ? ' class="active"' : '' ?>>Кіру</a>
        <a href="register.php" class="btn-sm">Тіркелу</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main class="container">
