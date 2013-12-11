<?php

interface Payuapi_Order_Message
	{
	
	public function setOrderDocument( $document );
	
	public function setOrderSession( $session );
	
	public function saveOrder();
	
	}
