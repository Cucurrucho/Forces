<?php
class Db {

    protected $conn;
    protected $selectVar;
    protected $whereVar;
    protected $tableVar;

    function __construct($serverName, $userName, $password, $dbName)
    {

        $this->conn = new mysqli($serverName, $userName, $password, $dbName);

        if ($this->conn->connect_error) {
            
            throw new Exception ($this->conn->connect_error);

        }
    }
    function insert ($info) {
        $query = "INSERT INTO " . $this->tableVar;
        $query .= "(";
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


        if (! $result = $this->conn->query($query) ){

            throw new Exception($this->conn->error);
        }
        return $result;
    }

    function select ($selector){
        $query = "SELECT $selector FROM " . $this->tableVar;

        $this->selectVar = $query;
        return $this;
    }

    function where ($info){
        $query = " WHERE ";
        foreach ($info as $array) {
            $query .=  "$array[0] $array[1] $array[2]";
        }
        $this->whereVar = $query;
        return $this;
    }
    
    function get () {
        $query = $this->selectVar . " " . $this->whereVar;
        return $this->conn->query($query);
    }

    function table ($tableName) {
        $this->tableVar = $tableName;
        return $this;
    }


}
?>