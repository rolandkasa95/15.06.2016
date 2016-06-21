<?php

require_once "databaseConnection.php";

if (isset($_GET['username'])){
    echo $_GET['username'];
    $databaseConnection = new databaseConnection();
    $databaseConnection->Checkout($_GET['username']);
    header("Location: costumerBuying.php");
}