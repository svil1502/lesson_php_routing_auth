<?php


require 'database/QueryBuilder.php';
$db=New QueryBuilder();
$data=[

    "id" => $_GET['id'],
    "title" => $_POST['title'],
    "content" => $_POST['content']

];

$db->updateOne($data, "tasks");

header("Location: /"); exit;