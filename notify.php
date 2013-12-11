<?php

class Payuapi_Notify extends Payuapi_Base
	{
	
	private $_Notify;
	private $_request_session_id;
	
	public function __construct( Payuapi_Config $config, $document )
		{
		
		$this->_Notify = OpenPayU_Order::consumeMessage( $document, FALSE, self::$DEBUG );
		
		Payuapi_Exception::assert( $this->_Notify->getSuccess(), Payuapi_Exception::RESPONSE_INVALID_MESSAGE );
		Payuapi_Exception::assert(
			$this->_Notify->getMessage() === self::REQUEST_NOTIFY,
			Payuapi_Exception::RESPONSE_INVALID_TYPE,
			array( ':msg' => $this->_Notify->getMessage() ) );
		
		}
	
	public function retrieve( Payuapi_Notify_Message $Message )
		{
		
		$Retrieve	= OpenPayU_Order::retrieve( $this->_Notify->getSessionId(), self::$DEBUG );
		$Request	= $Retrieve->getRequest();
		$Response	= $Retrieve->getResponse();
		
		$this->_request_session_id = $Request[ 'SessionId' ];
		
		$Message->setNotifySession( $Request[ 'SessionId' ] );
		$Message->setNotifyDocument( $Retrieve->getResponse() );
		$Message->saveNotify();
		
		$status	= $Retrieve->getStatus();
		$assert = Payuapi_Exception::assert(
			$Retrieve->getSuccess(),
			Payuapi_Exception::RESPONSE_RETRIEVE_FAIL,
				array(
					':err'	=> $Retrieve->getError(),
					':loc'	=> isset( $status[ 'Location' ] ) ? $status[ 'Location' ] : NULL,
					':msg'	=> $Retrieve->getMessage() ) );

		if( $assert )
			{
			$order_retrieve_response = $Response[ 'OpenPayU' ][ 'OrderDomainResponse' ][ 'OrderRetrieveResponse' ];
			$success = null;
			switch( $order_retrieve_response[ 'OrderStatus' ] )
				{
				case self::ORDER_COMPLETE:
					switch( $order_retrieve_response[ 'PaymentStatus' ] )
						{
						case self::PAYMENT_END:
							$success = true;
							break;
						case self::PAYMENT_CANCEL:
						case self::PAYMENT_REJECT:
						case self::PAYMENT_REJECT_DONE:
						case self::PAYMENT_NOAUTH:
						case self::PAYMENT_ERROR:
							$success = false;
						}
					break;
				case self::ORDER_CANCEL:
				case self::ORDER_REJECT:
					$success = false;
				}
			return array(
				'order'		=> $order_retrieve_response[ 'OrderStatus' ],
				'payment'	=> $order_retrieve_response[ 'PaymentStatus' ],
				'success'	=> $success );
			}
		return $Retrieve->getError();
			
		}
	
	public function getSessionId()
		{
		
		return $this->_request_session_id;
		
		}
		
	}
