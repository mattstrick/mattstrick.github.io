<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/gym.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare gym object
$gym = new Gym($db);
  
// read the details of gym to be edited
$gym->readLastAmenitiesRow();

if($gym->id!=null){
    // create array
    $amenities_arr = array(
        "id" => $gym->id,
        "opengym" => $gym->opengym,
        "pool" => $gym->pool,
        "shower" => $gym->shower,
        "locallyowned" => $gym->locallyowned,
        "parking" => $gym->parking,
        "nutrition" => $gym->nutrition,
        "personaltraining" => $gym->personaltraining,
        "climbingwall" => $gym->climbingwall
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($amenities_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user gym does not exist
    echo json_encode(array("message" => "Amenities does not exist."));
}
?>