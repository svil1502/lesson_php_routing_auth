<?php

//если сессия не запущена, запускаем сессию
if (!session_status())
{
    session_start();
}
require '../database/QueryBuilder.php';
require '../components/Auth.php';
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

//роутинг
$url=$_SERVER['REQUEST_URI'];
//var_dump($url);
if ($url=='/list'){
    require '../index.php';
    echo "here";
}
elseif ($url=='/contact'){
    require '../show.php';
}

