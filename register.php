<?php
$pageTitle = 'Тіркелу';
$active = 'register';
$errors = [];
$success = false;
$name = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $pass   = $_POST['password'] ?? '';
    $pass2  = $_POST['password2'] ?? '';

    if (mb_strlen($name) < 2 || mb_strlen($name) > 100) $errors['name'] = 'Аты 2–100 таңба болуы керек.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))      $errors['email'] = 'Email дұрыс емес.';
    if (strlen($pass) < 6)                               $errors['password'] = 'Пароль кемінде 6 таңба болуы керек.';
    if ($pass !== $pass2)                                $errors['password2'] = 'Парольдер сәйкес емес.';

    if (!$errors) {
        $success = true;       
    }
}
include __DIR__ . '/../includes/header.php';
?>
<div class="auth-wrap">
  <div class="auth-side"><h2>Бізге қосыл 📚</h2><p>Тіркеліп, кітаптарды онлайн қарызға ал.</p></div>
  <div class="auth-form">
    <h1>Тіркелу</h1>
    <?php if ($success): ?>
      <div class="alert ok">Рақмет, <?= e($name) ?>! Деректер дұрыс. (Аккаунт сақтау 11-аптада қосылады.)</div>
      <a class="btn" href="login.php">Кіру бетіне</a>
    <?php else: ?>
    <form method="post" action="register.php" data-validate novalidate>
      <label>Аты-жөні
        <input type="text" name="name" value="<?= e($name) ?>" class="<?= isset($errors['name']) ? 'invalid' : '' ?>" required>
        <span class="field-error" <?= isset($errors['name']) ? 'style="display:block"' : '' ?>><?= e($errors['name'] ?? '') ?></span>
      </label>
      <label>Email
        <input type="email" name="email" value="<?= e($email) ?>" placeholder="name@mail.kz" class="<?= isset($errors['email']) ? 'invalid' : '' ?>" required>
        <span class="field-error" <?= isset($errors['email']) ? 'style="display:block"' : '' ?>><?= e($errors['email'] ?? '') ?></span>
      </label>
      <label>Пароль
        <span class="pw-wrap"><input type="password" name="password" class="<?= isset($errors['password']) ? 'invalid' : '' ?>" required><button type="button" class="pw-toggle">Көрсету</button></span>
        <span class="hint">Кемінде 6 таңба</span>
        <span class="field-error" <?= isset($errors['password']) ? 'style="display:block"' : '' ?>><?= e($errors['password'] ?? '') ?></span>
      </label>
      <label>Парольді қайталау
        <input type="password" name="password2" class="<?= isset($errors['password2']) ? 'invalid' : '' ?>" required>
        <span class="field-error" <?= isset($errors['password2']) ? 'style="display:block"' : '' ?>><?= e($errors['password2'] ?? '') ?></span>
      </label>
      <button class="btn btn-block" type="submit">Тіркелу</button>
    </form>
    <p>Аккаунт бар ма? <a href="login.php">Кіру</a></p>
    <?php endif; ?>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
