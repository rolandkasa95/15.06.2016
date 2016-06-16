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
            $sql = "SELECT * FROM users WHEN password=:password && username=:username";
            $result = $this->pdo->prepare($sql)->execute(array(md5($password),$username));
            foreach($result as $row){
                echo $row['username'];
                echo $row['password'];
            }
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }
    }
}