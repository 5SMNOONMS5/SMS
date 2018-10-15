<?php

namespace Tasb00429\Sms;

use Tasb00429\Sms\Factory\SMSProviderFactory;

class SMSManager
{	
	public static function provider($provider)
	{
		return SMSProviderFactory::provider(strtolower($provider));
	}
}










