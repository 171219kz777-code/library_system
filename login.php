<?php
require_once __DIR__ . '/../includes/auth.php';

if (is_logged_in()) {
    header('Location: profile.php');
    exit;
}

$error = '';
$email = '';

$flash = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if ($email === '' || $pass === '') {
        $error = 'Email мен парольді енгізіңіз.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password_hash'])) {
            session_regenerate_id(true);              // сессияны жаңарту (қауіпсіздік)
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: profile.php');
            exit;
        }
        $error = 'Email немесе пароль қате.';
    }
}

$pageTitle = 'Кіру';
$active = 'login';
include __DIR__ . '/../includes/header.php';
?>
<div class="auth-wrap">
  <div class="auth-side"><h2>Қош келдің! 👋</h2><p>Кіріп, кітаптарды қарызға ал, өз қарыздарыңды қара.</p></div>
  <div class="auth-form">
    <h1>Кіру</h1>
    <?php if ($flash): ?><div class="alert ok"><?= e($flash) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert err"><?= e($error) ?></div><?php endif; ?>
    <form method="post" action="login.php" data-validate novalidate>
      <label>Email
        <input type="email" name="email" value="<?= e($email) ?>" placeholder="name@mail.kz" required>
        <span class="field-error"></span>
      </label>
      <label>Пароль
        <span class="pw-wrap"><input type="password" name="password" required><button type="button" class="pw-toggle">Көрсету</button></span>
        <span class="field-error"></span>
      </label>
      <button class="btn btn-block" type="submit">Кіру</button>
    </form>
    <p>Аккаунт жоқ па? <a href="register.php">Тіркелу</a></p>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
