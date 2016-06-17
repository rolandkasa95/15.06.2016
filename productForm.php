<?php

require_once 'databaseConnection.php';

$type = $_GET["type"];
$color = $_GET["color"];
$mass = $_GET["mass"];
if(isset($type) && isset($color) && isset($mass)){
    $obj = new databaseConnection();
    $obj->updateQuery("products",$mass,$type,$color);
    header("Location: costumerBuying.php");
}