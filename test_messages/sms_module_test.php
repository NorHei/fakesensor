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
$text   = "Hallo wie Gehts, lass uns testen!"; 

// fetch from module factory
$sender = $modules->SendSms;
// Do sending
$response = $sender->sendMessage($text, $phone);

// Response should be 100

echo "\nResponse: ". $response. " (should be 100 to be ok) \n\n";
 
