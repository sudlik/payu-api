<?php

interface Payuapi_Notify_Message
	{
	
	public function setNotifyDocument( $document );
	
	public function setNotifySession( $session );
	
	public function saveNotify();
	
	}
