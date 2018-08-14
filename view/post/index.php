<?php if(count($articles)):?>
    <?php foreach ($articles as $article) :?>
        <a href="post/<?=$article['id']?>"><?=$article['title']?></a> | <?=$article['id']?><br>
        <?=$article['content']?><br>
        <small><?=date("F j, Y, g:i a",$article['date'])?></small><br><br>
    <?php endforeach; ?>
<?php endif; ?>
    <hr>
<?php //if(isAuth()):?>
    <a href="post/create">Добавить</a><br>
<!--    <a href="index.php?controller=login&logout=true">Выход ( --><?//=$_SESSION['login']?><!-- )</a><br>-->
<?php //else: ?>
<!--    <a href="index.php?controller=login">Вход</a><br>-->
<?php //endif; ?>