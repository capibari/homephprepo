<?php if($msg != ''): ?>
    <strong><?= $msg?></strong><br>
<?php endif; ?>

<form method="post">
    Название<br>
    <input type="text" name="title" value="<?= $name?>"><br>
    Содержание<br>
    <textarea name="content" ><?=$content?></textarea><br>
    <input type="submit" value="Добавить">
</form>
<hr>
<a href="\">Главная</a><br>