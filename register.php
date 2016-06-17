<?php

require_once 'databaseConnection.php';

$user = $_GET['user'];
$password = $_GET['password'];
$email = $_GET['email'];

if(!isset($user) || !isset($password) || !isset($email)){
    exit();
}else{
    $databaseConnection = new databaseConnection();
    $boolean = $databaseConnection->Insert($user,$password,$email);
    if ($boolean){
        header("Location: printDatabase.html");
    }else{
        header("Location: register.html");
    }
}