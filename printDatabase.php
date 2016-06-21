<?php

require_once 'databaseConnection.php';

/**
 * Class printDatabase
 *
 * This class prints the products to a table
 * form, it is called within the costumerBuying.php
 * file
 */

class printDatabase
{

    public $result;

    public function __construct($bool)
    {
        $databaseConnection = new databaseConnection();
        if ($bool){
            $this->result = $databaseConnection->printDatabase("*","products",NULL);
        }else{
            $this->result = $databaseConnection->printDatabase("username,paymant","users",NULL);
        }

    }


    public function tableForm($bool)
    {
        if($bool)
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
        }else{
            foreach($this->result as $row)
            {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>\$" . $row["paymant"] . "</td>";
                echo "</tr>";
            }
        }
        
    }
}