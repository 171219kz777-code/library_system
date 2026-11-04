<?php
require_once __DIR__ . '/functions.php';
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
    <a class="logo" href="index.php">📚 Кітапхана</a>
    <button class="menu-btn" id="menuBtn" aria-label="Мәзір" aria-expanded="false">☰</button>
    <nav id="menu">
      <a href="index.php"<?= $active==='index' ? ' class="active"' : '' ?>>Басты бет</a>
      <a href="books.php"<?= $active==='books' ? ' class="active"' : '' ?>>Кітаптар</a>
      <a href="login.php"<?= $active==='login' ? ' class="active"' : '' ?>>Кіру</a>
      <a href="register.php" class="btn-sm">Тіркелу</a>
    </nav>
  </div>
</header>
<main class="container">
