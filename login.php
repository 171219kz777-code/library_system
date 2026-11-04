<?php
$pageTitle = 'Кіру';
$active = 'login';
$errors = [];
$success = false;
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Email дұрыс емес.';
    if ($pass === '')                               $errors['password'] = 'Парольді енгізіңіз.';
    if (!$errors) {
        $success = true;       
    }
}
include __DIR__ . '/../includes/header.php';
?>
<div class="auth-wrap">
  <div class="auth-side"><h2>Қош келдің! 👋</h2><p>Кіріп, кітаптарды қарызға ал, өз қарыздарыңды қара.</p></div>
  <div class="auth-form">
    <h1>Кіру</h1>
    <?php if ($success): ?>
      <div class="alert ok">Форма дұрыс толтырылған. (Нақты кіру жүйесі 11-аптада қосылады.)</div>
      <a class="btn" href="books.php">Кітаптарға өту</a>
    <?php else: ?>
    <form method="post" action="login.php" data-validate novalidate>
      <label>Email
        <input type="email" name="email" value="<?= e($email) ?>" placeholder="name@mail.kz" class="<?= isset($errors['email']) ? 'invalid' : '' ?>" required>
        <span class="field-error" <?= isset($errors['email']) ? 'style="display:block"' : '' ?>><?= e($errors['email'] ?? '') ?></span>
      </label>
      <label>Пароль
        <span class="pw-wrap"><input type="password" name="password" class="<?= isset($errors['password']) ? 'invalid' : '' ?>" required><button type="button" class="pw-toggle">Көрсету</button></span>
        <span class="field-error" <?= isset($errors['password']) ? 'style="display:block"' : '' ?>><?= e($errors['password'] ?? '') ?></span>
      </label>
      <button class="btn btn-block" type="submit">Кіру</button>
    </form>
    <p>Аккаунт жоқ па? <a href="register.php">Тіркелу</a></p>
    <?php endif; ?>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
