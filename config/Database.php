<?php

class Database
{
    // db parameter
    private $host = 'localhost';
    private $db_name = 'php-api-blog';
    private $username = 'root';
    private $password = '';
    private $conn ;

    // db connect
    public function connect()
    {
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,
                                $this->username,$this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        }catch(PDOException $e){
        return 'error'.$e->getMessage();
        }
        
        return $this->conn;
    }

}
