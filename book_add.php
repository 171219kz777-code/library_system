<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();                       

$genres = get_genres($pdo);
$errors = [];
$book = ['title' => '', 'author' => '', 'genre_id' => 0, 'year' => date('Y'), 'copies' => 1, 'description' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    list($book, $errors) = validate_book($pdo, $_POST);

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO books (title, author, genre_id, year, description, copies) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$book['title'], $book['author'], $book['genre_id'], $book['year'], $book['description'], $book['copies']]);

        $_SESSION['flash'] = 'Кітап сәтті қосылды!';
        header('Location: book.php?id=' . $pdo->lastInsertId());
        exit;
    }
}

$pageTitle = 'Кітап қосу';
$active = 'add';
include __DIR__ . '/../includes/header.php';
?>
<div class="card form-card wide">
  <h1>Жаңа кітап қосу</h1>
  <?php $action = 'book_add.php'; $buttonText = 'Қосу'; include __DIR__ . '/../includes/book_form.php'; ?>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
