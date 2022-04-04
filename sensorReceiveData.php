<?php

class sensorReceiveData {
    
    /** @var string $jsonData
     */
    public $jsonData;
    
    /**
     * @return bool|string
     */
    public function receive($postVars) {
        
        $this->jsonData = $postVars['jsonData'];
        
        $data = $this->convertFromJson();
        
        return $data;
    }
    
    /**
     * @return false|string
     */
    protected function convertFromJson() {
        
        
        $json = json_decode($this->jsonData);
        return $json;
    }
}
?>