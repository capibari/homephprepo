    <h3><?=$post['title']?></h3>
    <small><?=$post['content'];?></small>
    <p><?=$post['date'];?></p>
    <hr>
    <form method="post">
        <button type="submit" name="result" value="true">Да</button>
        <button type="submit" name="result" value="false">Нет</button>
    </form>

<?php //if(isAuth() && !$msg):?>
<a href="update\<?=$post['id']?>">Редактировать</a><br>
<?php //endif;?>
<a href="\">Главная</a><br>