<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/gym.php';
  
// instantiate database and gym object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$gym = new Gym($db);
  
// set LAT, LNG property of record to read
$gym->latLower = isset($_GET['latLower']) ? $_GET['latLower'] : die();
$gym->lngLower = isset($_GET['lngLower']) ? $_GET['lngLower'] : die();
$gym->latUpper = isset($_GET['latUpper']) ? $_GET['latUpper'] : die();
$gym->lngUpper = isset($_GET['lngUpper']) ? $_GET['lngUpper'] : die();

// query gyms
$stmt = $gym->readWithinBounds();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // gyms array
    $gyms_arr=array();
    $gyms_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $gym_item=array(
            "name" => $name,
            "lat" => $lat,
            "lng" => $lng,
            "address" => $address,
            "phone" => $phone,
            "price" => $price,
            "opengym" => $opengym,
            "pool" => $pool,
            "shower" => $shower,
            "locallyowned" => $locallyowned,
            "femaleowned" => $femaleowned,
            "minorityowned" => $minorityowned, 
            "parking" => $parking, 
            "nutrition" => $nutrition, 
            "personaltraining" => $personaltraining,
            "climbingwall" => $climbingwall,
            "bootcamp" => $bootcamp,
            "boxing" => $boxing, 
            "crossfit" => $crossfit,
            "hiit" => $hiit,
            "spin" => $spin,
            "swim" => $swim,
            "yoga" => $yoga,
            "zumba" => $zumba
        );
  
        array_push($gyms_arr["records"], $gym_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show gyms data in json format
    echo json_encode($gyms_arr);
} 

elseif ($num==0) {
    // set response code - 200 OK
    http_response_code(200);

    $gyms_arr=array();
    $gyms_arr["records"]=array();

    // show gyms data in json format
    echo json_encode($gyms_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no gyms found
    echo json_encode(
        array("message" => "No gyms found.")
    );
}