<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = ?');
$stmt->execute([$id]);
$book = $stmt->fetch();
if (!$book) {
    http_response_code(404);
    die('Кітап табылмады. <a href="books.php">Каталогқа қайту</a>');
}

$genres = get_genres($pdo);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    list($book, $errors) = validate_book($pdo, $_POST);
    $book['id'] = $id;

    if (!$errors) {
        $stmt = $pdo->prepare('UPDATE books SET title = ?, author = ?, genre_id = ?, year = ?, description = ?, copies = ? WHERE id = ?');
        $stmt->execute([$book['title'], $book['author'], $book['genre_id'], $book['year'], $book['description'], $book['copies'], $id]);

        $_SESSION['flash'] = 'Кітап жаңартылды.';
        header('Location: book.php?id=' . $id);
        exit;
    }
}

$pageTitle = 'Кітапты өңдеу';
$active = 'books';
include __DIR__ . '/../includes/header.php';
?>
<div class="card form-card wide">
  <h1>Кітапты өңдеу</h1>
  <?php $action = 'book_edit.php?id=' . $id; $buttonText = 'Сақтау'; include __DIR__ . '/../includes/book_form.php'; ?>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
