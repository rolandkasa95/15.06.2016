<?php

/**
 * Created by PhpStorm.
 * User: roland
 * Date: 16.06.2016
 * Time: 14:05
 */
class databaseConnection
{

    public $dsn="mysql:host=localhost;dbname=oop";
    public $username="root";
    public $password="Kasamargit22";
    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
        }
        catch(PDOException $e){
            echo "Ooops, we got an error: " . $e->getMessage();
        }
        return $this->pdo;
    }

    public function Select($username,$password)
    {
        if(!isset($username) || !isset($password)){
            exit();
        }else {
            $this->pdo = self::__construct();
            echo $username . '     ' . $password . '      ';
            $sql = "SELECT * FROM users WHERE username=:username AND password=:password";
            $statment = $this->pdo->prepare($sql);
            $statment->bindParam(':username',$username);
            $statment->bindParam(':password',md5($password));
            $statment->execute();
            $result = $statment->fetch(PDO::FETCH_ASSOC);
            var_dump($result);
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }
    }
}