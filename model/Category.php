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

    public function getCategorySingle()
    {
        //create querry
        $query = 'SELECT id, name FROM '.$this->table.' WHERE id = :id';

        //prepate query
        $stmt = $this->conn->prepare($query);
        
        //bind id
        $stmt->bindParam(':id',$this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->name = $row['name'];
    }

    public function createCategory()
    {
        // create query
        $query = 'INSERT INTO '.$this->table.'
                    SET
                    name =:name';
        
        // prepare stament
        $stmt= $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags(($this->name)));

        // bind param

        $stmt->bindParam(':name',$this->name);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n",$stmt->error);
        return false;
    }

    public function updateCategory()
    {
        //create query
        $query = 'UPDATE '.$this->table.' SET name = :name WHERE id = :id';

        //stament
        $stmt= $this->conn->prepare($query);

        //clean data
        $this->name = html_entity_decode(strip_tags($this->name));
        $this->id = html_entity_decode(strip_tags($this->id));

        //bind param
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':id',$this->id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n",$stmt->error);
        return false;
    }
}