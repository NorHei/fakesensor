<?php
/**
 * Self deserializig data object.
 * 
 * Call it whith:
* ```php
 * $myDataObject = dataObject::Deserialize($_POST['jsonData']);
 * ```
 */
class DataObject {
      
    /** @var string $title */
    public $title;
    
    /** @var string $hash */
    public $hash;
    
    /** @var float|int $tempValue */
    public $tempValue;
    
    /** @var float|int $temperature */
    public $temperature;
    
    /** @var int $co2Ppm */
    public $co2Ppm;
    
    /** @var float|int $co2Value */
    public $co2Value;
    
    /** @var string $ipAddress*/
    public $ipAddress;


    /**
     * Deserialize static method 
     * 
     * This is more or less a self factory that creates an instance of the dataclass and fills 
     * it whith the attribures aqired from JSON string. If there are inconsintencies whith 
     * those attributes it will fail and return an empty object.
     * 
     *  @return object/false 
     */
    public static function Deserialize($jsonString)
    {
        if (empty($jsonString)) return (object)[];   // Returns empty Object

        $classInstance = new DataObject();
        
        // needed for check if all are filled
        $cProperties = count((array)$classInstance);

        $jsonString = json_decode($jsonString);
        
        $cFilled = 0;

        foreach ($jsonString as $key => $value) {
            if (!property_exists($classInstance, $key)) continue;

            $classInstance->{$key} = $value;
            $cFilled++;
        }
        
        // All properties have been filled
        if ($cFilled == $cProperties) return $classInstance;

        // concerning PHP manual its better to use both
        $classInstance = NULL;
        unset($classInstance);

        return (object)[];   // Returns empty Object
    } 
    

    

}

