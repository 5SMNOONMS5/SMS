<?php

namespace Maxin\Sms\Factory;

use App;
use InvalidArgumentException;

class SMSProviderFactory 
{
	/**
     * Get a provider instance.
     *
     * @param  string  $provider
     * @return provider instance 
     *
     * @throws \InvalidArgumentException
     */
	static public function provider($provider = null)
	{	
		if (is_null($provider)) {
			throw new InvalidArgumentException('No provider was specified.');
		}

		$instancePath = config('sms.' . $provider .'.class');

		if (is_null($instancePath)) {
            throw new InvalidArgumentException(sprintf(
                'Unable to resolve NULL provider for [%s].', static::class
            ));
        }

		return App::make($instancePath);
	}
}