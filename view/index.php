<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title><?=$title?></title>
    </head>
<!--    <a href>Войти</a><br>-->
    <a href="/post">Записи</a>
    |:|
    <a href="/user">Пользователи</a>
    |:|
    <hr />
    <body>
        <?=$content?>

        <?php if ($msg):?>
            <div style="background-color: darkgray; color: indianred;">
                <?php foreach ($msg as $title => $errors):?>
                    <p><strong><<?=$title?></strong></p>
                    <ul>
                        <?php foreach ($errors as $error):?>
                            <li><?= $error?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach;?>
            </div>
        <?php endif; ?>

    </body>
</html>