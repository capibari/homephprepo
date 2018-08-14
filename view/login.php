<?php if($error != ''):?>
    <strong><?= $error?></strong>
<?php endif;?>

<?php if(!isAuth()):?>
    <form method="post">
        Логин<br>
        <input type="text" name="login"><br>
        Пароль<br>
        <input type="password" name="password"><br>
        <input type="checkbox" name="remember">Запомнить<br>
        <input type="submit" value="Войти">
    </form>
<?php else: ?>
    <a href="index.php?controller=login&logout=true">Выход ( <?=$_SESSION['login']?> )</a><br>
<?php endif; ?>
<hr>
<a href="index.php">Главная</a><br>