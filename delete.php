<?php

/**
 * Delete From Database
 *
 * When the HTML code executes the delete
 * form then this code is called, it takes
 * two parameters the @param string $password,
 * and the @param string $user
 *
 *
 */

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

/**
 * Deletion successful
 *
 * If the deletion is made then the
 * it will be redirected to register.html
 */

if($boolean){
    header("Location: register.html");
    echo "succesful";
}else{
    header("Location: register.html");
}