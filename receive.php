<?php
require_once ('dataObject.php');

echo"dfdfdfdf";

$myDataObject = dataObject::Deserialize($_POST['jsonData']);

print_r($myDataObject);



