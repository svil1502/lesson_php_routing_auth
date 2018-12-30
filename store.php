<?php
// $_POST

//отправки письма

//отправки СМС

//уведомления админа

//уведомления определенного пользователя


require 'database/QueryBuilder.php';
$db=New QueryBuilder();

//$id=$_GET['id'];
$db->store($_POST, "tasks");


header("Location: /"); exit;



