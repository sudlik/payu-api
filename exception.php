<?php

class Payuapi_Exception extends Exception
	{
	
	const
		REQUEST_CREATE_FAILURE		= 'Create order failure. Error: :err. Location: :loc. Message: :msg.',
		RESPONSE_INVALID_MESSAGE	= 'Invalid message.',
		RESPONSE_INVALID_TYPE		= 'Invalid message type: :msg.',
		RESPONSE_RETRIEVE_FAIL		= 'Retrieve notify failure. Error: :err. Location: :loc. Message: :msg.',
		RESPONSE_INVALID_PARAM		= 'Invalid _POST[ "DOCUMENT" ]: :doc.';
	
	public static function instance( $msg = NULL, array $var = NULL )
		{
		
		if( Payuapi_Base::$DEBUG )
			{
			OpenPayU::printOutputConsole();
			}
		
		if( $msg && $var )
			{
			$msg = strtr( $msg, $var );
			}
		
		return new self( $msg );
		
		}
	
	public static function assert( $test, $msg = NULL, array $var = NULL )
		{
		
		if( !$test )
			{
			throw self::instance( $msg, $var );
			}
		
		return $test;
		
		}
	
	}
