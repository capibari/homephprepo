    Логин: <b><?=$user['login']?></b><br>
    Имя: <b><?=$user['name'];?></b><br>
    <br>
    Удалить?
    <form method="post">
        <button type="submit" name="result" value="true">Да</button>
        <button type="submit" name="result" value="false">Нет</button>
    </form>
    <hr>
<?php //if(isAuth() && !$msg):?>
<a href="edit\<?=$post['id']?>">Редактировать</a><br>
<?php //endif;?>
<a href="\">Главная</a><br>