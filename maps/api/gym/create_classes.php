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
    $gym->bootcamp = $data->bootcamp;
    $gym->boxing = $data->boxing;
    $gym->crossfit = $data->crossfit;
    $gym->hiit = $data->hiit;
    $gym->spin = $data->spin;
    $gym->swim = $data->swim;
    $gym->yoga = $data->yoga;
    $gym->zumba = $data->zumba;
  
    // create the gym
    if($gym->createClasses()){
  
        if($gym->id!=null){
            // create array
            $gym_arr = array(
                "id" => $gym->id,                
            );
          
            // set response code - 200 OK
            http_response_code(200);
          
            // make it json format
            echo json_encode($gym_arr);
        }

        // set response code - 201 created
        // http_response_code(201);
  
        // tell the user
        // echo json_encode(array("message" => "Classes was created."));
    }
  
    // if unable to create the gym, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create classes."));
    }
?>