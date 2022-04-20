<?php
/**
 * This fakesensor class is made to create simple testsensor scripts that can be callled via cron
 * 
 * index.php is an example 
 */
class fakeSensor {

    /////////////////////////////////
    // Class variables
    // Json export only exports public vars so most are public

    // These are all public so the are included in JSON convert
    
    /** @var string $title */
    public $title = 'Test Sensor Default';
    
    /** @var string $hash */
    public $hash = "test default hash";
    
    /** @var float|int $tempValue */
    public $tempValue = 0;
    
    /** @var float|int $temperature */
    public $temperature = 0;
    
    /** @var int $co2Ppm */
    public $co2Ppm = 0;
    
    /** @var float|int $co2Value */
    public $co2Value = 0;
    
    /** @var string $ipAddress*/
    public $ipAddress = '123.2.2.7';
    
    // The next ones are protected so they are not included in JSON convert
    // Keep in mind that you neet to use the setters or otherwise PHP will
    // do strange things in the JsonObject

    /** @var string $pushUrl */
    protected $pushUrl;

    /** @var array $jsonData*/
    protected $jsonData=array();
 
    /** @var string $randomMode*/
    private $randomMode="normal";

    /** @var string $randomActive*/
    protected $randomActive=true;

    // End class variables
    ///////////////////////////////////

    ///////////////////////////////////
    // Collectiion of Setters 
    
    /**
     * @param String $title
     * @return void
     */
    public function setTitle($title="Test Sensor Setter") {
            $this->title = $title;
    }
    
    /**
     * @param String $hash
     * @return void
     */
    public function setHash($hash='test setter hash') {
            $this->hash = $hash;
    }
    
    /**
     * @param Float $tempValue
     * @return void
     */
    public function setTempValue($tempValue=1) {
            $this->tempValue = $tempValue;
    }
    
    /**
     * @param Float $temperature
     * @return void
     */
    public function setTemperature($temperature=1) {
            $this->temperature = $temperature;
    }
    
    /**
     * @param Int $co2Ppm
     * @return void
     */
    public function setCo2Ppm($co2Ppm=1) {
            $this->co2Ppm = $co2Ppm;
    }
    
    /**
     * @param Float $co2Value
     * @return void
     */
    public function setCo2Value($co2Value=1) {
            $this->co2Value = $co2Value;
    }

    /**
     * @param string $ipAddress
     * @return void
     */
    public function setIpAddress($ipAddress='123.2.2.5') {
        $this->ipAddress = $ipAddress;
    }
    
    /**
     * @param String $pushUrl
     * @return void
     */
    public function setPushUrl($pushUrl="https//www.google.de") {
            $this->pushUrl = $pushUrl;    
    }

    /**
     * @param String $randomMode
     * @return void
     */
    public function setRandomMode($randomMode="normal") {
        $this->randomMode = $randomMode;    
    }
    
    /**
     * @param String $randomActive
     * @return void
     */
    public function setRandomActive($randomActive=true) {
        $this->randomActive = $randomActive;    
    }

    // Getters and Setters End    
    //////////////////////////////////////    

    //////////////////////////////////////
    // Main Methods    

    /**
     * Simple constructor set the PostUrl and Modes and calls the construction methods if needed 
     * 
     * @param string $pushUrl
     * @return void
     */
    public function __construct ($pushUrl="", $randomActive=true, $randomMode="normal") {
        $this->setPushUrl($pushUrl);    
        $this->setRandomActive($randomActive);
        $this->setRandomMode($randomMode);
    }
   
    /**
     * Generates random data for the object
     * 
     * If class is set to randomMode!="normal" it will generate wild utf-8 strings for all fields
     *
     *@return void 
     */
    protected function generateRandomData(){
        if (!$this->randomActive) return;

        $glitchme = random_int(0, 100); // Approx. every 5th run
        
        // Don't go full crap data every time 
        if ($this->randomMode!="normal" AND 
            $glitchme % 5  == 0  // Approx. every 5th  run
        ) {
            // Really crappy Data
            $this->title       = $this->random_string(random_int(0,1000));
            $this->hash        = $this->random_string(random_int(0,1000));            
            $this->tempValue   = $this->random_string(random_int(0,10));      
            $this->temperature = $this->random_string(random_int(0,20)); 
            $this->co2Ppm      = $this->random_string(random_int(0,20)); 
            $this->co2Value    = $this->random_string(random_int(0,20));           
            $this->ipAddress   = $this->random_string(random_int(0,15)); 

        } 
        elseif ($this->randomMode!="normal" AND 
                $glitchme % 6  == 0  // Approx. every 6th  run
        ) {
            // From time to time remove an attribute
            $this->hash = NULL;
            unset($this->hash);
        }

        else {
            // Standard changing Data
            $this->tempValue   = random_int(0,1000) * 0.97;
            $this->temperature = random_int(-20, 40);
            $this->setCo2Ppm   (random_int(200, 1000));
            $this->co2Value    = random_int(500,2000) * 0.97;
        }
    }

    /**
     * Possibly generate random data, convert object to JSON and trigger sending.
     *
     * @return bool|string
     */
    public function send() {

        // Generate random data if $this->randomActive true
        $this->generateRandomData();

        // Convert object data to POST array
        $this->jsonData = array('jsonData' => json_encode($this, JSON_PRETTY_PRINT));

        // Trigger sending
        $sendResult = $this->sendData();
        return $sendResult;
    }
    
    /**
     * Do the actual sending of data 
     * 
     * @param $jsonData
     * @return bool|string
     */
    protected function sendData() {
        
        $curl = curl_init($this->pushUrl);
        
        $options = array(
            CURLOPT_POST           => true,
            CURLOPT_HEADER         => 0,
            CURLOPT_POSTFIELDS     => $this->jsonData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false // To operate on selfsigning certificates.
        );
        
        curl_setopt_array( $curl, $options);
        
        $output = curl_exec($curl);
        
        curl_close($curl);
        
        return $output;
    }

    // End main Methods
    ///////////////////////////////////////////////////

    ///////////////////////////////////////////////////
    // Helper Methods 

    /**
     *  Generates Random UTF-8 Strings of given length
     * 
     * @param int $length
     * @return string
     */
    protected function random_string($length) : string {
        $r = "";

        for ($i = 0; $i < $length; $i++) {
            $codePoint = mt_rand(0x80, 0xffff);
            $char = \IntlChar::chr($codePoint);
            if ($char !== null && \IntlChar::isprint($char)) {
                $r .= $char;
            } else {
                $i--;
            }
        }

        return $r;
    }

    /**
     * Creates random float
     * 
     * @return float
     */
    protected function random_float(){
        $iout = random_int(-1000000000, 1000000000);
        return $iout / 999;
    }

    /**
     * Creates random IP Address
     * 
     * @return string
     */
    protected function random_ip(){
        $iout = (str)(random_int(0, 255)).".".(str)(random_int(0, 255))."." .(str)(random_int(-255, 255)).".".(str)(random_int(0, 255));
        return $iout;
    }

    // End Helper Methods
    /////////////////////////////////////////////////////////

} // End class fakeSensor

