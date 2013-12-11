<?php

/*
	ver. 1.9.2
	OpenPayU Standard Library

	@copyright  Copyright (c) 2011-2012 PayU
	@license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
	http://www.payu.com
	http://openpayu.com
	http://twitter.com/openpayu
*/

include_once('openpayu_domain.php');

define('OPENPAYU_LIBRARY', true);
/*
these files are obsolete and will be removed in future.
valid only for SDK 0.x
*/
include_once('lib/OpenPayUNetwork.php');
include_once('lib/OpenPayUBase.php');
include_once('lib/OpenPayU.php');
include_once('lib/OpenPayUOAuth.php');

/* 
these files are 1.x compatible
*/
include_once('lib/Result.php');
include_once('lib/ResultOAuth.php');
include_once('lib/Configuration.php');
include_once('lib/Order.php');
include_once('lib/OAuth.php');
