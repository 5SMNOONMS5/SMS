<?php

namespace Maxin\Sms;

class Error
{	
	
    /**
     * Response message
     *
     * @var string
     */
    public $message;

    /**
     * Provider name
     *
     * @var string
     */
    public $provider;

    /**
     * The error code from each provider
     *
     * @var string
     */
    public $code;

    /**
     * The detail for the error
     *
     * @var string
     */
    public $detail;

    public function __construct($provider)
    {
        $this->setProvider($provider);
    }

    /**
     * Map the given array onto the sms's properties.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function map(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}