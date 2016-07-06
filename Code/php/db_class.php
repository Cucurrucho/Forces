<?php
class Db {

    protected $conn;
    protected $selectVar;
    protected $whereVar;
    protected $tableVar;
    protected $andVar;
    protected $orVar;
    protected $editVar;

    public function __construct($serverName, $userName, $password, $dbName)
    {

        $this->conn = new mysqli($serverName, $userName, $password, $dbName);

        if ($this->conn->connect_error) {
            
            throw new Exception ($this->conn->connect_error);

        }
    }
    public function insert ($info) {
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

    public function select ($selector){
        $query = "SELECT $selector FROM " . $this->tableVar;

        $this->selectVar = $query;
        return $this;
    }

    public function where ($column, $operator, $condition){
        $query = " WHERE $column $operator $condition";
        $this->whereVar = $query;
        return $this;
    }
    
    public function get () {
        $query = $this->selectVar . " " . " " . $this->editVar . " " . $this->whereVar . " " . $this->andVar . " " . $this->orVar;
        echo $query;
        return $this->conn->query($query);
    }

    public function table ($tableName) {
        $this->tableVar = $tableName;
        return $this;
    }

    public function andWhere ($column, $operator, $condition){
        $query = " AND $column $operator $condition";
        $this->andVar = $query;
        return $this;
    }

    public function orWhere ($column, $operator, $condition){
        $query = " OR $column $operator $condition";
        $this->orVar = $query;
        return $this;
    }

    public function edit ($info) {
        $query = "UPDATE " . $this->tableVar;
        $query .= " SET";
        foreach ($info as $array){
            $query .= " $array[0] $array[1] $array[2],";
        }
        $query = substr($query, 0, -1);
        $this->editVar = $query;
        return $this;

    }
}
?>