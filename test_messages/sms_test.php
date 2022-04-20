<?php  namespace ProcessWire;

/**
* Sending SMS manual test 
*
* Basic test to test if the SMS77.io Api is functional.
* just call this from the commandline. 
*/

$path = "../../index.php";
$path = realpath($path);

// fetch PW
include $path;

echo ("\nPath: " .$path. "\n");
echo "\nPw Loaded...\n";

// // call to send Sms
$call  = "https://gateway.sms77.io/api/sms?";
$call .= "p=lSKZIRA4GpsqENF86fxt2ZEgVjsYdbvPwevSYg7oFR5tJIae8ORr4WnmqKv9i6ZH";
$call .= "&to=00491783417997";
$call .= "&text=Hallo%20Wie%20%0AGehts%21";
$call .= "&from=Sensors"; 

// Disable checking certificate
$arrContextOptions = array(
    'ssl' => array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
    ),
);  

$response = file_get_contents($call, false, stream_context_create($arrContextOptions));

echo "\n Response: ". $response. "\n";

