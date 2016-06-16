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
    public function Insert($username,$password,$email){
        if (!isset($username) || !isset($password) || !isset($email)) {
            echo "Nice try, but please insert all the data!";
            exit();
        }else if(!$this->Select($username,$password)){
            $this->pdo = self::__construct();
            echo $username.$password,$email;
            $sql = "INSERT INTO users (username,password,email) VALUES (?,?,?)";
            $result = $this->pdo->prepare($sql)->execute(array($username,(md5($password)),$email));
            if ($result){
                return true;
            }else{
                return false;
            }
        }
    }
}