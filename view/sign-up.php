<form method="post">
    Поля отмеченные звезочкой (*) обязательны к заполнению<br><br>

    <input type="text" name="login" value="<?= $login?>">Логин *<br><br>

    <input type="password" name="password" value="">Пароль *<br><br>

    <input type="password" name="confirm" value="">Подтвердить *<br><br>

    <input type="text" name="name" value="<?= $name?>"> Имя<br><br>
    <input type="submit" value="Создать">
</form>
