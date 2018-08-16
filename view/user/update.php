<?php if($errors):?>
    <?var_dump($errors) ?>
    <hr>
<?php endif;?>


<form method="post">
    <input type="text" name="login" value="<?= $login?>">Логин<br><br>
    <input type="text" name="name" value="<?= $name?>"> Имя<br><br>
    <input type="submit" value="Изменить">

</form>
<hr>
<a href="\user">Назад</a><br>