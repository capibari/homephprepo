<?php if($errors):?>
    <?var_dump($errors) ?>
    <hr>
<?php endif;?>

<form method="post">
    Название<br>
    <input type="text" name="title" value="<?= $name?>"><br>
    Содержание<br>
    <textarea name="content" ><?=$content?></textarea><br>
    <input type="submit" value="Добавить">
</form>
<hr>
<a href="\">Главная</a><br>