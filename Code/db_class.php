<?php
class Db {

    private $conn;

    function __construct($serverName, $userName, $password, $dbName)
    {

        $this->conn = new mysqli($serverName, $userName, $password, $dbName);

        if ($this->conn->connect_error) {
            
            throw new Exception ($this->conn->connect_error);

        }
        else {
        }
    }
    function insert ($tableName, $info) {
        $query = "INSERT INTO $tableName (";
        foreach ($info as $column => $value){
            $query .= " $column,";
        }
        $query = substr($query, 0, -1);
        $query .= ")
        VALUES (";

        foreach ($info as $value) {
            $query .= " '$value',";
        }
        $query = substr($query, 0, -1);

        $query .= ")";


        if ($this->conn->query($query) === true){
        }
        else {
            throw new Exception($this->conn->error);
        }
    }
}
?>