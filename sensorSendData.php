<?php

class sensorSendData {

/////////////////////////////////
// Class variables
// Json export only exports public vars so most are public
    
    /** @var string $title */
    public $title = '';
    
    /** @var string $hash */
    public $hash = '';
    
    /** @var float|int $tempValue */
    public $tempValue = 0;
    
    /** @var float|int $temperature */
    public $temperature = 0;
    
    /** @var int $co2Ppm */
    public $co2Ppm = 0;
    
    /** @var float|int $co2Value */
    public $co2Value = 0;
    
    /** @var string $ipAddress*/
    public $ipAddress = '123.2.2.5';
    
    /** 
     * Url is protected so its not send via Json
     * 
     * @var string $pushUrl
     */
    protected $pushUrl = '';

// End class variables
///////////////////////////////////

///////////////////////////////////
// Collectiion of Setters 
    
    /**
     * @param String $title
     * @return void
     */
    public function setTitle($title) {
        if(!empty($title)) {
            $this->title = $title;
        }
    }
    
    /**
     * @param String $hash
     * @return void
     */
    public function setHash($hash) {
        if(!empty($hash)) {
            $this->hash = $hash;
        }
    }
    
    /**
     * @param Float $tempValue
     * @return void
     */
    public function setTempValue($tempValue) {
        if(!empty($tempValue)) {
            $this->tempValue = $tempValue;
        }
    }
    
    /**
     * @param Float $temperature
     * @return void
     */
    public function setTemperature($temperature) {
        if(!empty($temperature)) {
            $this->temperature = $temperature;
        }
    }
    
    /**
     * @param Int $co2Ppm
     * @return void
     */
    public function setCo2Ppm($co2Ppm) {
        if(!empty($co2Ppm)) {
            $this->co2Ppm = $co2Ppm;
        }
    }
    
    /**
     * @param Float $co2Value
     * @return void
     */
    public function setCo2Value($co2Value) {
        if(!empty($co2Value)) {
            $this->co2Value = $co2Value;
        }
    }
    
    /**
     * @param String $pushUrl
     * @return void
     */
    public function setPushUrl($pushUrl) {
        if(!empty($pushUrl)) 
            $this->pushUrl = $pushUrl;           
    }
  
// Getters and Setters End    
//////////////////////////////////////    


//////////////////////////////////////
// Main Methods    

    public function __construct ($pushUrl="") {
        echo "Purl: $pushUrl \n";
        $this->setPushUrl($pushUrl);
        
    }
    
    /**
     * Convert object to Json and trigger sending
     *
     * @return bool|string
     */
    public function send() {
        
        $jsonData = array('jsonData' => $this->convertToJson());
        echo "Json: $jsonData[jsonData] \n";
        
        
        $sendData = $this->sendData($jsonData);
        
        return $sendData;
    }
    
    /**
     * Convert the object data into json
     * 
     * @return false|string
     */
    protected function convertToJson() {
        $jsonString = json_encode($this);

        return $jsonString;
    }
    
    /**
     * Do the actual sending of data 
     * 
     * @param $jsonData
     * @return bool|string
     */
    protected function sendData($jsonData) {
        
        $curl = curl_init($this->pushUrl);
        //$curl = curl_init('https://mein-kaffe.de/da/test.php');
        
        $options = array(
            CURLOPT_POST           => true,
            CURLOPT_HEADER         => 0,
            CURLOPT_POSTFIELDS     => $jsonData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );
        
        curl_setopt_array( $curl, $options);
        
        $output = curl_exec($curl);
        
        curl_close($curl);
        
        return $output;
    }


// End main Methods
//////////////////////////////////////////////////7
}

