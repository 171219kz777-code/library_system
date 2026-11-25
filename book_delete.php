<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: books.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);
$stmt = $pdo->prepare('DELETE FROM books WHERE id = ?');
$stmt->execute([$id]);

$_SESSION['flash'] = $stmt->rowCount() ? 'Кітап жойылды.' : 'Кітап табылмады.';
header('Location: books.php');
exit;
