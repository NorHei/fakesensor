<?php  namespace ProcessWire;

/**
* Warlert  modul manual test 
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

$room = $pages->get(1031);
$text   = "Warnung Raum {$room->naming} CO2 WEr zu hoch!!"; 
$level  = "alert";
$headline = "CO2 Warnung {$room->naming}";  



// fetch from module factory
$warlert = $modules->SendOutWarlert;
// Do sending
$response = $warlert->send($headline, $text, $room, $level);

// Response should be 100

echo "\nResponse: ";

print_r ($response);

