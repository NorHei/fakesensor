<?php
include ('dataObject.php');

echo"RECIEVED\n";

$myDataObject = dataObject::Deserialize($_POST['jsonData']);

print_r($myDataObject);



