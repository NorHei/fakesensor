<?php

require_once ('sensorReceiveData.php');


$receiveData = new sensorReceiveData();

$data = $receiveData->receive($_POST);


vardump($data);


function vardump($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

?>