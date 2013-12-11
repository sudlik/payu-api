<?php

class Payuapi_Order extends Payuapi_Base
	{
	
	const
		PATTERN_NAME		= '#^([^\s]+)\s(.*)$#',
		ORDER_TYPE			= 'VIRTUAL',
		CURRENCY_CODE		= 'PLN',
		LANGUAGE			= 'pl_PL',
		TAX					= 0;
	
	private
		$_session	= NULL,
		$_data		= array();
	
	public function __construct( Payuapi_Config $Config, Payuapi_Order_Message $Message, Payuapi_Order_Entity $Entity, Payuapi_Order_Customer $Customer )
		{
			
		$this->_Config	= $Config;
		$this->_Message	= $Message;
		$this->_session	= $this->_getId();
		$this->_data	= $this->_getData( $Entity, $Customer );
		
		$this->_Message->setOrderSession( $this->_session );
		
		}
	
	private function _getName( $name )
		{

		$result = preg_match( self::PATTERN_NAME, trim( $name ), $match );
		
		if( $result )
			{
			return array(
				'first'	=> $match[ 1 ],
				'last'	=> $match[ 2 ] );
			}
		else
			{
		
			return array(
				'first'	=> $name,
				'last'	=> $name );
			
			}
		
		}
	
	private function _getId()
		{
		
		return md5( uniqid( null, true ) );
		
		}
	
	private function _getIp()
		{
		
		return $_SERVER[ 'REMOTE_ADDR' ];
		
		}
	
	private function _getDate( $date )
		{
		
		return date( 'c', strtotime( $date ) );
		
		}
	
	protected function _getData( Payuapi_Order_Entity $Entity, Payuapi_Order_Customer $Customer )
		{
		
		$data = array(
			'ReqId'				=> $this->_getId(),
			'CustomerIp'		=> $this->_getIp(),
			'NotifyUrl'			=> $Entity->getEntityNotifyUrl(),
			'OrderCancelUrl'	=> $Entity->getEntityCancelUrl(),
			'OrderCompleteUrl'	=> $Entity->getEntityCompleteUrl(),
			'Order'				=> array(
				'MerchantPosId'				=> $this->_Config->getMerchantPosId(),
				'SessionId'					=> $this->_session,
				'OrderCreateDate'			=> $this->_getDate( $Entity->getEntityCreatedAt() ),
				'OrderDescription'			=> $Entity->getEntityDescription(),
				'MerchantAuthorizationKey'	=> $this->_Config->getPosAuthKey(),
				'OrderType'					=> self::ORDER_TYPE,
				'ShoppingCart'				=> array(
					'GrandTotal'		=> 0,
					'CurrencyCode'		=> self::CURRENCY_CODE,
					'ShoppingCartItems'	=> array() ) ),
			'Customer'			=> array(
				'Email'		=> $Customer->getCustomerEmail(),
				'FirstName'	=> $Customer->getCustomerFirstName(),
				'LastName'	=> $Customer->getCustomerLastName(),
				'Language'	=> self::LANGUAGE,
				'Invoice'	=> array(
					'Street'			=> $Customer->getCustomerStreet(),
					'HouseNumber'		=> $Customer->getCustomerHouseNumber(),
					'ApartmentNumber'	=> $Customer->getCustomerApartmentNumber(),
					'PostalCode'		=> $Customer->getCustomerPostalCode(),
					'City'				=> $Customer->getCustomerCity(),
					'CountryCode'		=> 'PL',
					'AddressType'		=> 'BILLING',
					'RecipientName'		=> $Customer->getCustomerRecipientName(),
					'TIN'				=> $Customer->getCustomerTIN() ) ) );

		return $data;
		
		}
	
	public function setItem( Payuapi_Order_Item $Item )
		{
		
		$this->_data[ 'Order' ][ 'ShoppingCart' ][ 'GrandTotal' ] += $Item->getItemPrice() * $Item->getItemQuantity();
		
		$this->_data[ 'Order' ][ 'ShoppingCart' ][ 'ShoppingCartItems' ][] = 
			array(
				'ShoppingCartItem' => array(
					'Quantity'	=> $Item->getItemQuantity(),
					'Product'	=> array(
						'Name'		=> $Item->getItemName(),
						'UnitPrice'	=> array(
							'Gross'			=> $Item->getItemPrice() + self::TAX,
							'Net'			=> $Item->getItemPrice(),
							'Tax'			=> self::TAX,
							'CurrencyCode'	=> self::CURRENCY_CODE ) ) ) );
		
		return $this;
		
		}
	
	public function create( Closure $call )
		{
		
		$Create = OpenPayU_Order::create( $this->_data, self::$DEBUG );
		
		$this->_Message->setOrderDocument( $Create->getRequest() );
		$this->_Message->saveOrder();
		
		$status	= $Create->getStatus();
		$assert	= Payuapi_Exception::assert(
			$Create->getSuccess(),
			Payuapi_Exception::REQUEST_CREATE_FAILURE,
			array(
				':err'	=> $Create->getError(),
				':loc'	=> isset( $status[ 'Location' ] ) ? $status[ 'Location' ] : NULL,
				':msg'	=> $Create->getMessage() ) );

		if( $assert )
			{
			$call( $this->_Config, $this->_session );
			}
		
		}
	
	}
