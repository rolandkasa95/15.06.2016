<?php

/**
 * Class Login
 *
 * In this class
 */

require_once '/Model/Model.php';
require_once '/Model/Session.php';

class Login
{

    public $username;
    public $password;
    public $database;

    /**
     * Login constructor.
     * @param string $username
     * @param string $password
     *
     * This function initiates the username and the password,
     * when the object is created
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = md5($password);
    }

    /**
     * Set Username
     * @param string $username
     * 
     * Giving the parameter this function sets it
     * to the current object
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get Username
     * @return string
     * 
     * This function will return the Username,
     * which is a string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set Password
     * @param string $password
     * 
     * Giving a parameter this function sets it
     * to the current object
     */
    public function setPassword($password)
    {
        $this->password = md5($password);    
    }

    /**
     * Get Password
     * @return string
     * 
     * This function will return the Password,
     * which is a string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Check Login
     * @return boolean
     *
     * If the database exists then if the username and
     * the password are found in the database the the
     * stats
     */
    public function CheckDatabase()
    {
        if (Model::Connect() === false){
            echo "<h2>The database does not exist </h2>";
            return false;
        } else {
            $this->database = Model::Connect();
        }
        if (!$this->getPassword() and !$this->getUsername())
        {
            echo "<h2>Please enter the password and the username </h2>";
            return false;
        }
        else if(!Model::Select($this->getUsername(),$this->getPassword()))
        {
            echo "<h2>Please enter a valid username and password</h2>";
            return false;
        }else {
            Session::start();
            return true;
        }
    }

}