<?php
/**
 * Created by PhpStorm.
 * User: svetlanailina
 * Date: 2018-12-30
 * Time: 18:51
 */

class Auth
{

    public $db;
    public function __construct(QueryBuilder $db)
    {
        $this->db=$db;
    }

    public function register($email, $password)
{
$this->db->store([ 'email'=>$email, 'password'=>md5($password)],'users');

}

    public function login($email, $password)
{
    //проверить существует ли пользователь в базе
    // $user=@this->db->getUser($email, $password);
    $sql="Select * from users where email= :email and password = :password limit 1";
    $statement=$this->db->pdo->prepare($sql);
    $statement->bindParam(":email", $email);
    $password=md5($password);
    $statement->bindParam(":password", $password );
    $statement->execute();
    $user=$statement->fetch(2);
    //если существует записываем в сессиюи возвращаеам true
    if ($user){
        $_SESSION['user']=$user;
        return true;
    }
    //если не существует возвращаем false
    return false;
}
    public function logout()
{
    unset($_SESSION['user']);
}
    public function check()
    {
        if(isset($_SESSION['user'])) {

            return true;
        }
        return false;
    }
//если нет пользователя вернет null
    public function currentUser()
    {
        //if(isset($_SESSION['user'])) {
        if ($this->check()){

            return $_SESSION['user'];
        }

    }
}