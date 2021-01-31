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

// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->lat) &&
    !empty($data->lng) &&
    !empty($data->address) &&
    !empty($data->phone)
){
  
    // set gym property values
    $gym->name = $data->name;
    $gym->lat = $data->lat;
    $gym->lng = $data->lng;
    $gym->address = $data->address;
    $gym->phone = $data->phone;
  
    // create the gym
    if($gym->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Gym was created."));
    }
  
    // if unable to create the gym, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create gym."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create gym. Data is incomplete."));
}
?>