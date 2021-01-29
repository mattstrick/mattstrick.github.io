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

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                    name, lat, lng, address, phone
                FROM
                    " . $this->table_name . " p                    
                WHERE
                    p.lat = ? AND p.lng = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->lat);
        $stmt->bindParam(2, $this->lng);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->name = $row['name'];
        $this->lat = $row['lat'];
        $this->lng = $row['lng'];
        $this->address = $row['address'];
        $this->phone = $row['phone'];
    }
}
?>