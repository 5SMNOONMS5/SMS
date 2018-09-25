<?php

namespace Maxin\Sms;

use Maxin\Sms\Factory\SMSProviderFactory;

class SMSManager
{	
	public static function provider($provider)
	{
		return SMSProviderFactory::provider(strtolower($provider));
	}
}










