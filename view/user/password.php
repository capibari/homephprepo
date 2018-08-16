<?php if($errors):?>
    <?var_dump($errors) ?>
    <hr>
<?php endif;?>


<form method="post">
    <input type="password" name="oldPassword" ">Старый пароль<br><br>
    <input type="password" name="password" ">Новый пароль<br><br>
    <input type="password" name="confirm" ">Еще раз<br><br>
    <input type="submit" value="Изменить">
</form>
<hr>
<a href="\user">Назад</a><br>