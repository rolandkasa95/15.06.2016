<?php

require_once 'databaseConnection.php';

$password = $_GET['password'];
$user = $_GET['user'];
if (!isset($password) || !isset($user)){
    echo "Nice try but this is not your account";
    exit();
}
echo $password;
echo $user;
$databaseConnection = new databaseConnection();
$boolean = $databaseConnection->deleteQury("users",$password,$user);

if($boolean){
    header("Location: register.html");
    echo "succesful";
}else{
    header("Location: register.html");
}