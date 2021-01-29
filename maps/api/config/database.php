<?php
class Database{
  
    // specify your own database credentials
    private $host = "45.40.164.22";
    private $db_name = "gymsDB";
    private $username = "gymsDB";
    private $password = "iNRREYm7rVPcED8FJE!";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>