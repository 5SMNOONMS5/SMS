<?php

namespace Maxin\Sms;

use Maxin\Sms\Factory\SMSProviderFactory;

class SMS
{
	private $provider;
	
	public function provider($name)
	{
		return SMSProviderFactory::create(strtolower($name));
	}
}










