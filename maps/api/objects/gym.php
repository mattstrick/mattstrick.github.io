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
    public $price;
    public $opengym;
    public $pool; 
    public $shower; 
    public $locallyowned; 
    public $parking; 
    public $nutrition; 
    public $personaltraining;
    public $climbingwall;
    public $bootcamp;
    public $boxing;
    public $crossfit;
    public $hiit;
    public $spin;
    public $swim;
    public $yoga;
    public $zumba;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read gyms
    function read(){
    
        // select all query
        $query = "SELECT
                    p.name, 
                    p.lat, 
                    p.lng, 
                    p.address, 
                    p.phone, 
                    p.price,
                    a.opengym, 
                    a.pool, 
                    a.shower, 
                    a.locallyowned, 
                    a.parking, 
                    a.nutrition, 
                    a.personaltraining, 
                    a.climbingwall,
                    c.bootcamp,
                    c.boxing,
                    c.crossfit,
                    c.hiit,
                    c.spin,
                    c.swim,
                    c.yoga,
                    c.zumba
                FROM
                    " . $this->table_name . " p, amenities a, classes c
                WHERE
                    p.id = a.id AND p.id = c.id";
    
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
                    p.name, 
                    p.lat, 
                    p.lng, 
                    p.address, 
                    p.phone, 
                    p.price,
                    a.opengym, 
                    a.pool, 
                    a.shower, 
                    a.locallyowned, 
                    a.parking, 
                    a.nutrition, 
                    a.personaltraining, 
                    a.climbingwall,
                    c.bootcamp,
                    c.boxing,
                    c.crossfit,
                    c.hiit,
                    c.spin,
                    c.swim,
                    c.yoga,
                    c.zumba
                FROM
                    " . $this->table_name . " p , amenities a, classes c                   
                WHERE
                    p.lat = ? AND p.lng = ? AND p.id = a.id AND p.id = c.id
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
        $this->price = $row['price'];
        $this->opengym = $row['opengym'];
        $this->pool = $row['pool'];
        $this->shower = $row['shower'];
        $this->locallyowned = $row['locallyowned'];
        $this->parking = $row['parking'];
        $this->nutrition = $row['nutrition'];
        $this->personaltraining = $row['personaltraining'];
        $this->climbingwall = $row['climbingwall'];
        $this->bootcamp = $row['bootcamp'];
        $this->boxing = $row['boxing'];
        $this->crossfit = $row['crossfit'];
        $this->hiit = $row['hiit'];
        $this->spin = $row['spin'];
        $this->swim = $row['swim'];
        $this->yoga = $row['yoga'];
        $this->zumba = $row['zumba'];
    }

    // create gym
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, lat=:lat, lng=:lng, address=:address, phone=:phone, price=:price, classes_id=:classes_id";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->lat=htmlspecialchars(strip_tags($this->lat));
        $this->lng=htmlspecialchars(strip_tags($this->lng));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->classes_id=htmlspecialchars(strip_tags($this->classes_id));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":lat", $this->lat);
        $stmt->bindParam(":lng", $this->lng);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":classes_id", $this->classes_id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // create classes
    function createClasses() {
        // query to insert record
        $query = "INSERT INTO
                    classes
                SET
                    bootcamp=:bootcamp, boxing=:boxing, crossfit=:crossfit, hiit=:hiit, spin=:spin, swim=:swim, yoga=:yoga, zumba=:zumba";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":bootcamp", $this->bootcamp);
        $stmt->bindParam(":boxing", $this->boxing);
        $stmt->bindParam(":crossfit", $this->crossfit);
        $stmt->bindParam(":hiit", $this->hiit);
        $stmt->bindParam(":spin", $this->spin);
        $stmt->bindParam(":swim", $this->swim);
        $stmt->bindParam(":yoga", $this->yoga);
        $stmt->bindParam(":zumba", $this->zumba);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // read last classes row
    function readLastClassesRow() {
        // query to read single record
        $query = "SELECT
                    * 
                FROM
                    classes p                   
                ORDER BY ID DESC
                LIMIT
                    1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id = $row['id'];
        $this->bootcamp = $row['bootcamp'];
        $this->boxing = $row['boxing'];
        $this->crossfit = $row['crossfit'];
        $this->hiit = $row['hiit'];
        $this->spin = $row['spin'];
        $this->swim = $row['swim'];
        $this->yoga = $row['yoga'];
        $this->zumba = $row['zumba'];
    }
}
?>