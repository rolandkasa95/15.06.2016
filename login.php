<?php

/**
 * Created by PhpStorm.
 * User: roland
 * Date: 16.06.2016
 * Time: 14:04
 */

require_once 'databaseConnection.php';

error_log(E_ALL);


if (!isset($_GET['user']) || !isset($_GET['password'])){
    echo "i just say";
    exit();
}else{
    echo "something";
    $databaseConnection = new databaseConnection();
    $password = $_GET['password'];
    $user = $_GET['user'];
    $boolean = $databaseConnection->Select($user,$password);
    if ($boolean){
        echo "Login was successful";
    }else{
        echo "Login was unsuccessful";
    }
}