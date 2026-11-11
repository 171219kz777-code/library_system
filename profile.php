<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();      

$stmt = $pdo->prepare('SELECT name, email, role, created_at FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: logout.php');
    exit;
}

$pageTitle = 'Профиль';
$active = 'profile';
include __DIR__ . '/../includes/header.php';
?>
<div class="card form-card">
  <h1>👤 Профиль</h1>
  <p><strong>Аты-жөні:</strong> <?= e($user['name']) ?></p>
  <p><strong>Email:</strong> <?= e($user['email']) ?></p>
  <p><strong>Рөлі:</strong> <?= e($user['role']) ?></p>
  <p><strong>Тіркелген күні:</strong> <?= e($user['created_at']) ?></p>
  <a class="btn" href="logout.php">Шығу</a>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
