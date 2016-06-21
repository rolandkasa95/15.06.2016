<?php

require_once 'databaseConnection.php';

class databaseInsert extends databaseConnection
{
    public function dataInsert($table,$properties,$values){
        if(isset($table)){
            $sql = "INSERT INTO " . $table;
            if(isset($properties)){
                $sql .= " " .  $properties;
                if (isset($values)){
                    $sql .= " VALUES " . $values;
                }else{
                    exit();
                }
            }else{
                exit();
            }
        }else{
            exit();
        }
        echo $sql;
        $this->pdo = parent::__construct();
        $statement =  $this->pdo->prepare($sql);
        $statement->execute();
    }
}

$databaseInsert = new databaseInsert();
if (isset($_GET['mass']) && isset($_GET['color']) && isset($_GET['type']) && isset($_GET['price'])) {
    $databaseInsert->dataInsert("products","(mass,type,color,price)","(" . $_GET['mass'] . ",'" . $_GET['type'] . "','" . $_GET['color'] . "'," . $_GET['price'] . ")");
}