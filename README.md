# CleanJson
A simple wrapper around PHP's JSON functions giving a simple approach to error checking on decode.

## Example
All methods are static so an example useage would be as follows:
````
<?php
  if(Json::decode("{}", false) === false)
  {
    // string does not contain valid JSON data.
    echo Json::get_error_message();
  }
?>
````

## Why
This class is a simple wrapper around PHP's JSON functions. It aims to make error detection and parsing simpler than it currently is.
For example the `decode` method decodes a JSON string and returns the resulting object/array. If the decode operation fails the wrapper function will return FALSE, unlike the default implementation which returns NULL. 
The issue here being that a valid JSON string can be decoded and result in NULL also. This is not always desireable.

## License
Released under the MIT license.
