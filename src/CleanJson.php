<?php
namespace DavidFricker\CleanJson;
/**
 * JSON Wrapper Class
 *
 * This class is a simple wrapper around PHP's JSON functions.
 * It aims to make error detection and parsing simpler.
 * 
 * @author David Fricker, davidfricker.com
 * @version 1.0
 */
class CleanJson
{	
	/**
	 * decode
	 *
	 * Decodes a JSON string and returns resulting object/array.
	 * If decode operation fails the function will return FALSE, unlike the 
	 * default implementation which returns NULL. The issue being a valid 
	 * decode can also return NULL, meaning the JSON string was syntactically 
	 * correct but just empty.
	 */
	public static function decode($string, $assoc = FALSE)
	{
		$decode_result = @json_decode($string, $assoc);
		if($decode_result === NULL && json_last_error() !== JSON_ERROR_NONE)
		{
		    return FALSE;
		}

		return $decode_result;
	}

	public static function encode($object)
	{
		return json_encode($object);
	}

	private static function legacy_get_error_message()
	{
		switch(json_last_error())
		{
		    case JSON_ERROR_NONE:
		        $message = 'No errors.';
		    	break;
		    case JSON_ERROR_DEPTH:
		        $message = 'Maximum stack depth exceeded.';
		    	break;
		    case JSON_ERROR_STATE_MISMATCH:
		        $message = 'Underflow or the modes mismatch.';
		    	break;
		    case JSON_ERROR_CTRL_CHAR:
		        $message = 'Unexpected control character found.';
		    	break;
		    case JSON_ERROR_SYNTAX:
		        $message = 'Syntax error, malformed JSON.';
		    	break;
		    case JSON_ERROR_UTF8:
		        $message = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
		    	break;
		    default:
		        $message = 'Unknown Json error.';
		    	break;
		}

		return $message;
	}

	public static function get_error_message()
	{
		if(!function_exists('json_last_error_msg'))
		{
			return slef::legacy_get_error_message();
		}

		return json_last_error_msg();
	}
}