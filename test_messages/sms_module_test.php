<?php  namespace ProcessWire;

/**
* SMS modul manual test 
*
* Basic test to test the sending module for functionality
* just call this from the commandline. 
*/

// Fetch Processwire application
$path = "../../index.php";
$path = realpath($path);
include_once $path;

echo ("\nPath: " .$path. "\n");
echo "\nPw Loaded...\n";

$phone = "00491783417997";
$text   = "Hallo%20Wie%20%0AGehts%21"; 

$sender = $modules->SendSms;

$response = $sender->sendMessage($text, $phone);

echo "\n Response: ". $response. "\n";
 
