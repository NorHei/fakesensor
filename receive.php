<?php
require_once ('dataObject.php');

$myDataObject = dataObject::Deserialize($_POST['jsonData']);

print_r($myDataObject);
echo "dfdfdfdfdf";


