# Fakesensor
Fakesensor is for generating fake data for the application.

It creates a data object and then sends it via Http POST, encoded as Json String.

On the recieving end the class is more ore less a self factory that creates an 
instance of the dataclass(itself) and fills it whith the attribures aqired from 
JSON string. If there are inconsintencies whith those attributes it will fail and 
return an empty object.

