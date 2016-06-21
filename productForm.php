<?php

/**
 * Checksum
 *
 * After the user buys some vegetables this will
 * execute the updateQuery function which will set
 * the new @param string $mass 
 *
 */

require_once 'databaseConnection.php';

$type = $_GET["type"];
$color = $_GET["color"];
$mass = $_GET["mass"];
session_start();
$to      = $_SESSION['email'];
$subject = "Dear " . $_SESSION['username'];
$message = "You bought from us " . $mass . " kilogram " . $color . " " . $type . " food, you can check out when you come to the store!";
$headers = 'From: rolandkasa95@gmail.com' . "\r\n" .
    'Reply-To: rolandkasa95@gmail.com' . "\r\n";
$from = "From: FirstName LastName <rolandkasa95@gmail.com>";
mail($to, $subject, $message, $headers, $from);
if(isset($type) && isset($color) && isset($mass)){
    $obj = new databaseConnection();
    $obj->updateQuery("products",$mass,$type,$color);
    header("Location: costumerBuying.php");
}