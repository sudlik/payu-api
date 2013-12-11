<?php

interface Payuapi_Order_Entity
	{
	
	public function getEntityName();
	
	public function getEntityDescription();
	
	public function getEntityCreatedAt();
	
	public function getEntityNotifyUrl();
	
	public function getEntityCancelUrl();
	
	public function getEntityCompleteUrl();
	
	}
