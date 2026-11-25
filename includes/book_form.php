<?php
// Кітап қосу және өңдеу беттеріне ортақ форма
// Күтілетін айнымалылар: $book (массив), $errors (массив), $genres, $action (форма жіберілетін бет), $buttonText
?>
<form method="post" action="<?= e($action) ?>" novalidate>
  <label>Атауы
    <input type="text" name="title" value="<?= e($book['title']) ?>" class="<?= isset($errors['title']) ? 'invalid' : '' ?>" required>
    <span class="field-error" <?= isset($errors['title']) ? 'style="display:block"' : '' ?>><?= e($errors['title'] ?? '') ?></span>
  </label>
  <label>Автор
    <input type="text" name="author" value="<?= e($book['author']) ?>" class="<?= isset($errors['author']) ? 'invalid' : '' ?>" required>
    <span class="field-error" <?= isset($errors['author']) ? 'style="display:block"' : '' ?>><?= e($errors['author'] ?? '') ?></span>
  </label>
  <label>Жанр
    <select name="genre_id" class="<?= isset($errors['genre_id']) ? 'invalid' : '' ?>">
      <option value="0">— таңдаңыз —</option>
      <?php foreach ($genres as $g): ?>
        <option value="<?= (int)$g['id'] ?>" <?= (int)$book['genre_id'] === (int)$g['id'] ? 'selected' : '' ?>><?= e($g['name']) ?></option>
      <?php endforeach; ?>
    </select>
    <span class="field-error" <?= isset($errors['genre_id']) ? 'style="display:block"' : '' ?>><?= e($errors['genre_id'] ?? '') ?></span>
  </label>
  <label>Шыққан жылы
    <input type="number" name="year" value="<?= e($book['year']) ?>" class="<?= isset($errors['year']) ? 'invalid' : '' ?>" required>
    <span class="field-error" <?= isset($errors['year']) ? 'style="display:block"' : '' ?>><?= e($errors['year'] ?? '') ?></span>
  </label>
  <label>Даналар саны
    <input type="number" name="copies" value="<?= e($book['copies']) ?>" class="<?= isset($errors['copies']) ? 'invalid' : '' ?>" required>
    <span class="field-error" <?= isset($errors['copies']) ? 'style="display:block"' : '' ?>><?= e($errors['copies'] ?? '') ?></span>
  </label>
  <label>Сипаттама
    <textarea name="description" rows="5" class="<?= isset($errors['description']) ? 'invalid' : '' ?>"><?= e($book['description']) ?></textarea>
    <span class="field-error" <?= isset($errors['description']) ? 'style="display:block"' : '' ?>><?= e($errors['description'] ?? '') ?></span>
  </label>
  <div class="btn-row">
    <button class="btn" type="submit"><?= e($buttonText) ?></button>
    <a class="btn btn-light" href="books.php">Бас тарту</a>
  </div>
</form>
