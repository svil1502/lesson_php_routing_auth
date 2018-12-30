<?php


require 'database/QueryBuilder.php';
$db=New QueryBuilder();
$id=$_GET['id'];
$db->deleteOne($id, "tasks");

header('Location: /');