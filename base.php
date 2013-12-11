<?php

require_once 'vendor/init.php';

abstract class Payuapi_Base
	{
	
	const
		RESPONSE_CREATE		= 'OrderCreateResponse',
		RESPONSE_RETRIEVE	= 'OrderRetrieveResponse',
		RESPONSE_UPDATE		= 'OrderStatusUpdateResponse',
		RESPONSE_CANCEL		= 'OrderCancelResponse',
		RESPONSE_NOTIFY		= 'OrderNotifyResponse',
		RESPONSE_SHIPPING	= 'ShippingCostRetrieveResponse';
	
	const
		REQUEST_CREATE		= 'OrderCreateRequest',
		REQUEST_RETRIEVE	= 'OrderRetrieveRequest',
		REQUEST_UPDATE		= 'OrderStatusUpdateRequest',
		REQUEST_CANCEL		= 'OrderCancelRequest',
		REQUEST_NOTIFY		= 'OrderNotifyRequest',
		REQUEST_SHIPPING	= 'ShippingCostRetrieveRequest';
	
	const
		ORDER_NEW		= 'ORDER_STATUS_NEW',
		ORDER_COMPLETE	= 'ORDER_STATUS_COMPLETE',
		ORDER_CANCEL	= 'ORDER_STATUS_CANCEL',
		ORDER_REJECT	= 'ORDER_STATUS_REJECT',
		ORDER_PENDING	= 'ORDER_STATUS_PENDING',
		ORDER_SENT		= 'ORDER_STATUS_SENT';
	
	const
		PAYMENT_SENT		= 'PAYMENT_STATUS_SENT',
		PAYMENT_INIT		= 'PAYMENT_STATUS_INIT',
		PAYMENT_NEW			= 'PAYMENT_STATUS_NEW',
		PAYMENT_END			= 'PAYMENT_STATUS_END',
		PAYMENT_CANCEL		= 'PAYMENT_STATUS_CANCEL',
		PAYMENT_REJECT		= 'PAYMENT_STATUS_REJECT',
		PAYMENT_REJECT_DONE	= 'PAYMENT_STATUS_REJECT_DONE',
		PAYMENT_NOAUTH		= 'PAYMENT_STATUS_NOAUTH',
		PAYMENT_ERROR		= 'PAYMENT_STATUS_ERROR';
	
	const
		RESULT_SUCCESS							= 'OPENPAYU_SUCCESS',
		RESULT_WARNING							= 'OPENPAYU_WARNING',
		RESULT_DATA_NOT_FOUND					= 'OPENPAYU_DATA_NOT_FOUND',
		RESULT_SERVICE_NOT_AVAILABLE			= 'OPENPAYU_SERVICE_NOT_AVAILABLE',
		RESULT_ERROR_INTERNAL					= 'OPENPAYU_ERROR_INTERNAL',
		RESULT_ERROR_VALUE_MISSING				= 'OPENPAYU_ERROR_VALUE_MISSING',
		RESULT_ERROR_VALUE_INVALID				= 'OPENPAYU_ERROR_VALUE_INVALID',
		RESULT_ERROR_SYNTAX						= 'OPENPAYU_ERROR_SYNTAX',
		RESULT_ERROR_ORDER_NOT_UNIQUE			= 'OPENPAYU_ERROR_ORDER_NOT_UNIQUE',
		RESULT_ERROR_UNKNOWN_MERCHANT_POS		= 'OPENPAYU_ERROR_UNKNOWN_MERCHANT_POS',
		RESULT_ERROR_USER_NOT_UNIQUE			= 'OPENPAYU_ERROR_USER_NOT_UNIQUE',
		RESULT_SIGNATURE_INVALID				= 'OPENPAYU_SIGNATURE_INVALID',
		RESULT_ERROR_INCONSISTENT_CURRENCIES	= 'OPENPAYU_ERROR_INCONSISTENT_CURRENCIES',
		RESULT_BUSINESS_ERROR					= 'OPENPAYU_BUSINESS_ERROR',
		RESULT_WARNING_CONTINUE_CVV				= 'OPENPAYU_WARNING_CONTINUE_CVV',
		RESULT_WARNING_CONTINUE_3DS				= 'OPENPAYU_WARNING_CONTINUE_3DS';
	
	const
		ERROR_100 = 100,
		ERROR_101 = 101,
		ERROR_102 = 102,
		ERROR_103 = 103,
		ERROR_104 = 104,
		ERROR_105 = 105,
		ERROR_106 = 106,
		ERROR_107 = 107,
		ERROR_108 = 108,
		ERROR_109 = 109,
		ERROR_110 = 110,
		ERROR_111 = 111,
		ERROR_112 = 112,
		ERROR_113 = 113,
		ERROR_114 = 114,
		ERROR_115 = 115,
		ERROR_116 = 116,
		ERROR_117 = 117,
		ERROR_118 = 118,
		ERROR_119 = 119,
		ERROR_120 = 120,
		ERROR_121 = 121,
		ERROR_122 = 122,
		ERROR_123 = 123,
		ERROR_124 = 124,
		ERROR_125 = 125,
		ERROR_126 = 126,
		ERROR_127 = 127,
		ERROR_128 = 128,
		ERROR_129 = 129,
		ERROR_130 = 130,
		ERROR_131 = 131,
		ERROR_132 = 132,
		ERROR_200 = 200,
		ERROR_201 = 201,
		ERROR_202 = 202,
		ERROR_203 = 203,
		ERROR_204 = 204,
		ERROR_205 = 205,
		ERROR_206 = 206,
		ERROR_207 = 207,
		ERROR_208 = 208,
		ERROR_209 = 209,
		ERROR_211 = 211,
		ERROR_500 = 500,
		ERROR_501 = 501,
		ERROR_502 = 502,
		ERROR_503 = 503,
		ERROR_504 = 504,
		ERROR_505 = 505,
		ERROR_506 = 506,
		ERROR_507 = 507,
		ERROR_508 = 508,
		ERROR_599 = 599,
		ERROR_999 = 999;
	
	public static $DEBUG = FALSE;
		
	}
