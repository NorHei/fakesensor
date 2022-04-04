<?php

/**
 *  DeserializeJSON Abstract Class 
 * 
 *  Just extend your object whith this class and i can deserialize itself outoff a JSON string
 */

abstract class DeserializeJSON
{
    /**
     * Deserialize static function 
     * 
     * Basically the Checks itself for the class name and then uses the JSON 
     * string and something that is line a self producing factory. 
     *  
     * 
     * @param string $jsonString
     * @return $this
     */
    public static function Deserialize($jsonString)
    {
        $className = get_called_class();
        $classInstance = new $className();

        if 

        if (is_string($jsonString))
            $jsonString = json_decode($jsonString);

        
        foreach ($jsonString as $key => $value) {
            if (!property_exists($classInstance, $key)) continue;

            $classInstance->{$key} = $value;
        }

        return $classInstance;
    }
    /**
     * @param string $jsonString
     * @return $this[]
     */
    public static function DeserializeArray($jsonString)
    {
        $jsonString = json_decode($jsonString);
        $items = [];
        foreach ($jsonString as $item)
            $items[] = self::Deserialize($item);
        return $items;
    }
}