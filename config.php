<?php

class Payuapi_Config extends OpenPayU_Configuration
	{
	
	public function __construct( $env, $merchant_pos, $pos_auth, $id, $secret, $signature )
		{
			
		self::setEnvironment( $env );
		self::setMerchantPosId( $merchant_pos );
		self::setPosAuthKey( $pos_auth );
		self::setClientId( $id );
		self::setClientSecret( $secret );
		self::setSignatureKey( $signature );
		
		}
	
	public function setDebug( $debug = TRUE )
		{
		
		Payuapi_Base::$DEBUG = $debug;
		
		}
	
	}
