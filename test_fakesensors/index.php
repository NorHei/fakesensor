<?php
/**
 * This is the example file for building simulated sensors. 
 */

require_once ('fakeSensor.php');

// URL to send,  generate random values (true,false), send complete garbage packages from time to time ("normal", "killer").  
//$sendJson = new fakeSensor('https://mein-kaffe.de/cron/receive.php', true, "normal");
$sendJson = new fakeSensor('https://mein-kaffe.de/reciever/', true, "normal");

// Test file for detailed POST variables
//$sendJson = new fakeSensor('https://mein-kaffe.de/cron/post_test.php', false);

$sendJson->setTitle('Sensor 1');
$sendJson->setHash('Checkmich ich bin der hash');

//$sendJson->setTempValue(1.689);
//$sendJson->setTemperature(1.896);
//$sendJson->setCo2Ppm(2);
//$sendJson->setCo2Value(2.123);
$sendJson->setIpAddress("127.0.0.33");

$output = $sendJson->send();

echo ("Returned Output:\n");
print_r($output);
