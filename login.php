<?php

/**
 * Login
 *
 * This code will be executed when the login form is
 * submitted, it will call the Select function after
 * connecting to the database
 */

require_once 'databaseConnection.php';

error_log(E_ALL);


if (!isset($_GET['user']) || !isset($_GET['password'])){
    echo "i just say";
    exit();
}else{
    $databaseConnection = new databaseConnection();
    $password = $_GET['password'];
    $user = $_GET['user'];
    $boolean = $databaseConnection->Select($user,$password);
    if ($boolean){
        session_start();
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $password;
        header("Location: costumerBuying.php");
    }else{
        header("Location: register.html");
    }
}