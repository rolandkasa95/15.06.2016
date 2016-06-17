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
                $sql = "SELECT * FROM users WHERE username=:username";
                $statment = $this->pdo->prepare($sql);
                $statment->bindParam(':username',$username);
                $statment->execute();
                $result1 = $statment->fetch(PDO::FETCH_ASSOC);
                if ($result1){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
    public function Insert($username,$password,$email){
        if (!isset($username) || !isset($password) || !isset($email)) {
            echo "Nice try, but please insert all the data!";
            exit();
        }else if(!$this->Select($username,$password)){
            $this->pdo = self::__construct();
            $sql = "INSERT INTO users (username,password,email) VALUES (?,?,?)";
            $result = $this->pdo->prepare($sql)->execute(array($username,(md5($password)),$email));
            if ($result){
                return true;
            }else{
                return false;
            }
        }
    }

    public function printDatabase($select,$from,$where = NULL)
    {
        if(isset($select))
        {
            $sql = "SELECT " . $select;
            if(isset($from)) {
                $sql .= " FROM " . $from;
                if(isset($where)){
                    $sql.= " WHERE " . $where;
                }
            }
        }
        $this->pdo = self::__construct();
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteQury($table, $password, $username){
        if(isset($table)){
            $sql = "DELETE FROM " . $table;
            if(isset($username) && isset($password)){
                $sql .= " WHERE username='" . $username . "' AND password='" . md5($password) . "'" ;
            }
        }else{
            exit();
        }
        echo $sql;
        $this->pdo = self::__construct();
        $statement = $this->pdo->prepare($sql);
        $boolean = $statement->execute();
        var_dump($boolean);
        return $boolean;
    }

    public function updateQuery($table,$mass,$type,$color){
        if(isset($table)){
            $sql = "UPDATE " . $table;
            if(isset($mass)){
                $sql .= " SET mass=mass-" . $mass;
                if(isset($type) && isset($color)){
                    $sql .= " WHERE type='" . $type . "' AND color= '" . $color . "'";
                }else exit();
            }else exit();
        }else exit();
        $this->pdo= self::__construct();
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $result = self::printDatabase("price","products","type='" . $type . "' AND color='" . $color . "'");
        echo $result;
        foreach ($result as $row){
            $price = $row["price"];
        }
        session_start();
        $statement = $this->pdo->prepare("UPDATE users SET paymant=paymant+" . $mass*$price . " WHERE username='" .$_SESSION['username'] . "'");
        $statement->execute();
    }

    public function paymant(){
        session_start();
        $result = self::printDatabase("paymant","users","username='" . $_SESSION['username'] . "'");
        foreach ($result as $row){
            $paymant = $row["paymant"];
        }
        return $paymant;
    }
}