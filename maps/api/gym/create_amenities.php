<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate gym object
include_once '../objects/gym.php';
  
$database = new Database();
$db = $database->getConnection();
  
$gym = new Gym($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
    // set gym property values
    $gym->opengym = $data->opengym;
    $gym->pool = $data->pool;
    $gym->shower = $data->shower;
    $gym->locallyowned = $data->locallyowned;
    $gym->femaleowned = $data->femaleowned;
    $gym->minorityowned = $data->minorityowned;
    $gym->parking = $data->parking;
    $gym->nutrition = $data->nutrition;
    $gym->personaltraining = $data->personaltraining;
    $gym->climbingwall = $data->climbingwall;
  
    // create the gym
    if($gym->createAmenities()){
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Amenities was created."));
    }
  
    // if unable to create the gym, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create amenities."));
    }
?>