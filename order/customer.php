<?php

interface Payuapi_Order_Customer
	{
	
	public function getCustomerFirstName();
	
	public function getCustomerLastName();
	
	public function getCustomerEmail();
	
	public function getCustomerStreet();
	
	public function getCustomerHouseNumber();
	
	public function getCustomerApartmentNumber();
	
	public function getCustomerPostalCode();
	
	public function getCustomerCity();
	
	public function getCustomerRecipientName();
	
	public function getCustomerTIN();
	
	}
