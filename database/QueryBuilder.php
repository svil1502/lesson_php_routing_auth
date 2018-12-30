<?php

class QueryBuilder
{
    public $pdo;
function __construct()
{
    $this->pdo = new PDO("mysql:host=localhost; dbname=test", "root", "02091502");
}

//список задач
    function all($table)
    {

        $sql = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($sql); //подготовить
        $statement->execute(); //true || false
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

//сохранение новой задачи
    function store($data, $table)
{
    $keys=array_keys($data);
    $stringOfKeys=implode(',',$keys);
    $placeholders=':'.implode(',:', $keys);
    $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeholders)";
    $statement =  $this->pdo->prepare($sql);
    $statement->execute($data); //true || false
}

//выбрать задачу
    function getOne($id, $table)
{
    //$pdo = new PDO("mysql:host=localhost; dbname=test", "root", "02091502");
    $statement =  $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
    $statement->bindParam(":id", $_GET['id']);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//изменение задачи
    function updateOne($data, $table)
{
    $fields='';
    foreach ($data as $key => $value){
        $fields .= $key ."=:" . $key .",";
    }
    $fields=rtrim($fields,',');
    $sql = "UPDATE $table SET $fields WHERE id=:id";
    //var_dump($sql); die;
    $statement =  $this->pdo->prepare($sql);
    $r=$statement->execute($data); // true || false
    //var_dump($r); die;
}

//удаление задачи
    function deleteOne($id,$table)
{
    $sql = "DELETE FROM $table WHERE id=:id";
    $statement =  $this->pdo->prepare($sql);
    $statement->bindParam(":id", $id);
    $statement->execute();
}
}