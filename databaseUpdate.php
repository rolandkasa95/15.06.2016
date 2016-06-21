<?php

require_once "databaseConnection.php";

class databaseUpdate extends databaseConnection
{
    public function dataUpdate($table,$set,$where){
        if (isset($table)){
            $sql = "UPDATE " . $table;
            if (isset($set)){
                $sql .= " SET " . $set;
                if (isset($where)){
                    $sql .= " WHERE " . $where;
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

$databaseUpdate = new databaseUpdate();
if (isset($_GET['mass']) && isset($_GET['color']) && isset($_GET['type'])){
    $databaseUpdate->dataUpdate("products","mass=" . $_GET['mass'],"color='" . $_GET['color'] . "' AND type='" . $_GET['type'] . "'");
}