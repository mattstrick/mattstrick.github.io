<?php
$subject = htmlspecialchars($_GET["subject"]);
$message = htmlspecialchars($_GET["message"]);
$headers = 'From:"Matt Strick" <matt@barbellfinder.com>' . "\r\n" .
'Reply-To: <matt@barbellfinder.com>' . "\r\n" .
"X-Mailer: PHP/" . PHP_VERSION;

if(
    !empty($subject) &&
    !empty($message) 
){
    $retval = mail("<matt@barbellfinder.com>",$subject,$message,$headers);

    if( $retval == true ) {
        // set response code - 201 created
        http_response_code(201);
    
        // tell the user
        echo json_encode(array("message" => "Message sent successfully..."));
    }else {
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("message" => "Message could not be sent..."));
    }
}
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Message could not be sent. Data is incomplete."));
}
?>