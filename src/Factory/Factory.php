<?php

namespace Maxin\Sms\Factory;

use App;
use InvalidArgumentException;
use Maxin\Sms\Providers\Nexmo\Factory as NexmoFactory;
use Maxin\Sms\Providers\Yunpian\Factory as YunpianFactory; 

class SMSProviderFactory
{
	/**
     * Get a provider instance.
     *
     * @param  string  $provider
     * @return provider instance factory
     *
     * @throws \InvalidArgumentException
     */
	static public function provider($provider = null)
	{	
		if (is_null($provider)) {
			throw new InvalidArgumentException('No provider was specified.');
		}

        $config = config('sms.' . strtolower($provider));
        $class  = $config['class'];

		if (is_null($class)) {
            throw new InvalidArgumentException(sprintf(
                'Unable to resolve NULL provider class for [%s].', static::class
            ));
        }

        return (new $class($config));
	}
}