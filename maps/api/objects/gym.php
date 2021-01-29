<?php
class Gym{
  
    // database connection and table name
    private $conn;
    private $table_name = "gyms";
  
    // object properties
    public $id;
    public $name;
    public $lat;
    public $lng;
    public $address;
    public $phone;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read gyms
    function read(){
    
        // select all query
        $query = "SELECT
                    name, lat, lng, address, phone
                FROM
                    " . $this->table_name . " p";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>