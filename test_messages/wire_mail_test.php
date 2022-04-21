<?php  namespace ProcessWire;

/**
* Wire Modul manual test 
*
* Basic test to test the mail sending module for functionality
* just call this from the commandline. 
*/

// Fetch Processwire application
$path = "../../index.php";
$path = realpath($path);
include_once $path;

echo ("\nPath: " .$path. "\n");
echo "\nPw Loaded...\n";

$email = "norbert@heimsath.org,sgt.nops@gmx.net";
$text   = "Hallo wie Gehts, lass uns testen!"; 

// fetch object from module itself
$sender = wireMail();

// specify CSV string or array for multiple addresses
$sender ->to($email)
  ->subject('Co2News')
  ->body($text);

// Do sending
$response = $sender->send();

// Response should be 2

echo "\nResponse: ". (string)$response. " (should be 2 to be ok) \n\n";
 
