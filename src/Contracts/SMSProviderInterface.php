<?php

namespace Maxin\Sms\Contracts;

interface SMSProviderInterface
{
	public function send(int $mobileNumber, array $parameters);
}