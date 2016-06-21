<?php

/**
 * Class databaseConnection
 *
 * In this class is the database connection,
 * deletion, insertion done.
 */
class databaseConnection
{

    /**
     * Database parameter
     *
     * This specifies the host and the dbname
     * for the database connection
     *
     * @var string dsn
     */
    public $dsn="mysql:host=localhost;dbname=oop";
    /**
     * Username
     *
     * This specifies the username for the
     * database connection
     *
     * @var string username
     */
    public $username="root";
    /**
     * Password
     *
     * This specifies the password needed to
     * connect to the database
     *
     * @var string password
     */
    public $password="Kasamargit22";
    /**
     * Connection
     *
     * This variable stores the connection
     * to the database
     *
     * @var PDO connection
     */
    public $pdo;

    /**
     * databaseConnection constructor.
     *
     * This function is called in whenever a connection
     * is initialized and connects to the database, which
     * parameters were stored in the @param dsn, @param username,
     * @param password
     */
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

    /**
     * Select from database
     *
     * This function will help the login, and the registration
     * panel, becouse it check's if the user is in the database
     * returns true if he is in it, and false if he is not.
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
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

    /**
     * Registration
     *
     * This function insert a new user to the database,
     *first check's if every parameter is set, after it
     *check's if it's in the database, and if everything
     * is fine it will inserts the new user to the database
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @return bool
     */
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

    /**
     * Printing from database
     *
     * This function gets three parameter, and insert's
     * them into a sql variable, which after execution will
     * contain an array of values which was selected by the
     * user
     *
     * @param string $select
     * @param string $from
     * @param string null $where
     * @return array
     */
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

    /**
     * Delete from database
     *
     * This function again takes three parameters and
     * inserts them into an sql variable, which after
     * execution will delete the query which was selected
     *
     * @param string $table
     * @param string $password
     * @param string $username
     * @return bool
     */
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

    /**
     * Update the databse
     *
     * This function take four parameters,
     * and updates the database based on these four
     * parameters, after that it will calculate the paymant
     *
     * @param string $table
     * @param string $mass
     * @param string $type
     * @param string $color
     */
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

    /**
     * Paymant printing
     *
     * This function selects the paymant field from the
     * users table in which the username is selected
     *
     * @return integer
     */
    public function paymant(){
        session_start();
        $result = self::printDatabase("paymant","users","username='" . $_SESSION['username'] . "'");
        foreach ($result as $row){
            $paymant = $row["paymant"];
        }
        return $paymant;
    }
}