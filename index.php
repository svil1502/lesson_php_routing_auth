<?php
//если сессия не запущена, запускаем сессию
if (!session_status())
{
    session_start();
}
require 'database/QueryBuilder.php';
require 'components/Auth.php';
$db=New QueryBuilder();
$user=New Auth($db);
//$user->register('user@email.com','bsd');

function redirect($path) {
    header("Location: $path"); exit;
}
/*
if ($user->login('1','1')){
    redirect("/");
}
else {
    echo "Такого пользователя нет";
}
*/
var_dump($user->login('user@email.com','bsd'), $_SESSION);
//$validate->email('user@eaxample.com');
$user=$user->currentUser();
echo $user['email'];

//оставляем код отвечающий за работу данной страницы
$tasks=$db->all("tasks");
?>



<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>All Tasks</h1>
            <a href="create.php" class="btn btn-success">Add Task</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($tasks as $task):?>
                    <tr>
                        <td><?= $task['id'];?></td>
                        <td><?= $task['title'];?></td>
                        <td>
                            <a href="show.php?id=<?= $task['id'];?>" class="btn btn-info">
                                Show
                            </a>
                            <a href="edit.php?id=<?= $task['id'];?>" class="btn btn-warning">
                                Edit
                            </a>
                            <a onclick="return confirm('are you sure?');" href="delete.php?id=<?= $task['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>