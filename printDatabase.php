<?php

require_once 'databaseConnection.php';
    
class printDatabase
{

    public $result;

    public function __construct()
    {
        $databaseConnection = new databaseConnection();
        $this->result = $databaseConnection->printDatabase("*","products",NULL);
    }

    public function tableForm()
    {

        foreach($this->result as $row)
        {
            echo "<tr>";
            echo "<td>" . $row["mass"] . "</td>";
            echo "<td>" . $row["type"] . "</td>";
            echo "<td>" . $row["color"] . "</td>";
            echo "<td>\$" . $row["price"] . "</td>";
            echo "</tr>";
        }
        
    }
}