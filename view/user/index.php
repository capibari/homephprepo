<table
    <th>
        <td>#</td>
        <td>Login</td>
        <td>Name</td>
        <td>Tools</td>
    </th>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?=$user['id']?></td>
            <td><?=$user['login']?></td>
            <td><?=$user['name']?></td>
            <td>
                <a href="/user/update/<?=$user['id']?>">И</a> |
                <a href="/user/updatePassword/<?=$user['id']?>">П</a> |
                <a href="/user/delete/<?=$user['id']?>">У</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<a href="/user/create">Добавить нового пользователя</a>