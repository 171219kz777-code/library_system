<?php
function e($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function book_card($b) {
    $icons = ['📖', '📘', '📗', '📙', '📕'];
    $icon = $icons[$b['id'] % 5];
    $color = 'c' . (($b['id'] % 4) + 1);
    ob_start(); ?>
    <div class="card book">
      <div class="cover <?= $color ?>"><?= $icon ?></div>
      <h3><?= e($b['title']) ?></h3>
      <p><?= e($b['author']) ?>, <?= (int)$b['year'] ?></p>
      <span class="tag"><?= e($b['genre']) ?></span>
      <span class="tag <?= $b['copies'] > 0 ? 'free' : 'busy' ?>"><?= (int)$b['copies'] ?> дана</span>
      <div class="btn-row">
        <a class="btn btn-outline" href="book.php?id=<?= (int)$b['id'] ?>">Толығырақ</a>
      </div>
    </div>
<?php return ob_get_clean();
}

function pagination($page, $pages) {
    if ($pages <= 1) return '';
    $params = $_GET;                       
    $html = '<div class="pagination">';
    $link = function ($p, $text, $class = '') use ($params) {
        $params['page'] = $p;
        return '<a href="?' . e(http_build_query($params)) . '" class="' . $class . '">' . $text . '</a>';
    };
    if ($page > 1) $html .= $link($page - 1, '← Алдыңғы');
    for ($i = 1; $i <= $pages; $i++) {
        $html .= $link($i, $i, $i == $page ? 'active' : '');
    }
    if ($page < $pages) $html .= $link($page + 1, 'Келесі →');
    return $html . '</div>';
}

function get_genres($pdo) {
    return $pdo->query('SELECT id, name FROM genres ORDER BY name')->fetchAll();
}

function validate_book($pdo, $post) {
    $d = [
        'title'       => trim($post['title'] ?? ''),
        'author'      => trim($post['author'] ?? ''),
        'genre_id'    => (int)($post['genre_id'] ?? 0),
        'year'        => (int)($post['year'] ?? 0),
        'copies'      => (int)($post['copies'] ?? 0),
        'description' => trim($post['description'] ?? ''),
    ];
    $errors = [];
    if ($d['title'] === '' || mb_strlen($d['title']) > 200)    $errors['title'] = 'Атауы міндетті (ең көбі 200 таңба).';
    if ($d['author'] === '' || mb_strlen($d['author']) > 150)  $errors['author'] = 'Автор міндетті (ең көбі 150 таңба).';
    $stmt = $pdo->prepare('SELECT id FROM genres WHERE id = ?');
    $stmt->execute([$d['genre_id']]);
    if (!$stmt->fetch())                                       $errors['genre_id'] = 'Жанрды таңдаңыз.';
    if ($d['year'] < 1000 || $d['year'] > (int)date('Y'))      $errors['year'] = 'Жыл 1000 мен ' . date('Y') . ' аралығында болуы керек.';
    if ($d['copies'] < 0 || $d['copies'] > 1000)               $errors['copies'] = 'Даналар саны 0–1000 аралығында.';
    if (mb_strlen($d['description']) > 2000)                   $errors['description'] = 'Сипаттама тым ұзын (ең көбі 2000 таңба).';
    return [$d, $errors];
}
