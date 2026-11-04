<?php
function e($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function book_card(int $id, array $b): string {
    ob_start(); ?>
    <div class="card book">
      <div class="cover <?= e($b['color']) ?>"><?= e($b['icon']) ?></div>
      <h3><?= e($b['title']) ?></h3>
      <p><?= e($b['author']) ?>, <?= (int)$b['year'] ?></p>
      <span class="tag"><?= e($b['genre']) ?></span>
      <span class="tag <?= $b['free'] ? 'free' : 'busy' ?>"><?= $b['free'] ? 'Бос' : 'Бос емес' ?></span>
      <div class="btn-row">
        <a class="btn btn-outline" href="book.php?id=<?= $id ?>">Толығырақ</a>
        <a class="btn" href="login.php">Қарызға алу</a>
      </div>
    </div>
<?php return ob_get_clean();
}
