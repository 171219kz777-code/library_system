<?php
require_once __DIR__ . '/../includes/auth.php';

if (is_logged_in()) {
    header('Location: profile.php');
    exit;
}

$errors = [];
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';
    $pass2 = $_POST['password2'] ?? '';

    // 1. Деректерді тексеру
    if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
        $errors['name'] = 'Аты 2–100 таңба болуы керек.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email дұрыс емес.';
    }
    if (strlen($pass) < 6) {
        $errors['password'] = 'Пароль кемінде 6 таңба болуы керек.';
    }
    if ($pass !== $pass2) {
        $errors['password2'] = 'Парольдер сәйкес емес.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors['email'] = 'Бұл email бұрын тіркелген.';
        }
    }

    if (!$errors) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);   // парольді хэштеу
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $hash]);

        $_SESSION['flash'] = 'Тіркелу сәтті өтті! Енді жүйеге кіре аласың.';
        header('Location: login.php');
        exit;
    }
}

$pageTitle = 'Тіркелу';
$active = 'register';
include __DIR__ . '/../includes/header.php';
?>
<div class="auth-wrap">
  <div class="auth-side"><h2>Бізге қосыл 📚</h2><p>Тіркеліп, кітаптарды онлайн қарызға ал.</p></div>
  <div class="auth-form">
    <h1>Тіркелу</h1>
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
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
