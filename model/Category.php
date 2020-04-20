<?php

class Category
{
    private $conn;
    private $table = 'categories';

    public $id;
    public $name;
    public $created_at;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCategory()
    {
        //create query
        $query  = 'SELECT id, name FROM ' .$this->table.' ORDER BY created_at DESC';

        //prepare stament
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}