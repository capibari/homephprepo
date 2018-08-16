<?php if($errors):?>
    <?var_dump($errors) ?>
    <hr>
<?php endif;?>

<form method="post">
    Название<br>
    <input type="text" name="title" value="<?= $title?>"><br>
    Содержание<br>
    <textarea name="content" ><?=$content?></textarea><br>
    <input type="submit" value="Сохранить">
</form><hr>



<a href="\post\<?=$id?>">Вернуться</a><br>
<a href="\">Главная</a><br>