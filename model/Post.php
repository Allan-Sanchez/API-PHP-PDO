<?php

class Post
{
    private $conn;
    private $table = 'posts';


    //post propieties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //contructor with db
    public function __construct($db) {
        $this->conn = $db;
    }

    //get post
    public function getpost()
    {
        //create query
        $query = 'SELECT c.name AS category_name,
                    p.id, p.category_id, p.title, p.body, p.author, p.created_at
                FROM
                    '.$this->table.' p 
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY
                    P.created_at DESC';
        
        
        //prepare statemt
        $stmt = $this->conn->prepare($query);

        //execute querry
        $stmt->execute();

        return $stmt;

    }

    //get single post
    public function getPostSingle()
    {
        //create query
        $query = 'SELECT c.name AS category_name,
                        p.id, p.category_id, p.title, p.body, p.author, p.created_at
                    FROM
                        '.$this->table.' p 
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                    WHERE p.id = ?
                    LIMIT 0,1';
        
         //prepare statemt
         $stmt = $this->conn->prepare($query);

         //bind id
         $stmt->bindParam(1,$this->id);

         $stmt->execute();

         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->title = $row['title'];
         $this->author = $row['author'];
         $this->body = $row['body'];
         $this->category_id = $row['category_id'];
         $this->category_name = $row['category_name'];
 
        //  return $stmt;
 
    }

    public function createPost()
    {
        // create query
        $query = 'INSERT INTO '.$this->table.'
                    SET
                        title = :title,body =:body, 
                        author= :author, category_id =:category_id';
        
        //prepare statement
        $stmt =$this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // bind data
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':category_id',$this->category_id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n",$stmt->error);
        return false;
    }

    public function updatePost()
    {
        //create querry
        $query = 'UPDATE '.$this->table .'
                    SET
                    title = :title,body =:body, 
                    author= :author, category_id =:category_id
                    WHERE 
                    id = :id';

        //prepare stament
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':category_id',$this->category_id);
        $stmt->bindParam(':id',$this->id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n",$stmt->error);
        return false;
    }

    public function deletePost()
    {
        //create query
        $query = 'DELETE FROM '. $this->table .' WHERE id = :id';

         //prepare stament
         $stmt = $this->conn->prepare($query);

         //clean data
         $this->id = htmlspecialchars(strip_tags($this->id));
         
        //  bind data
         $stmt->bindParam(':id',$this->id);

         if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n",$stmt->error);
        return false;



    }

}