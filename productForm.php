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
if(isset($type) && isset($color) && isset($mass)){
    $obj = new databaseConnection();
    $obj->updateQuery("products",$mass,$type,$color);
    header("Location: costumerBuying.php");
}