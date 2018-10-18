<?php

namespace Maxin\Sms;

class Message
{   
    public function __construct($provider = "")
    {
        $this->setProvider($provider);
    }

    /**
     * The destination number
     *
     * @var string
     */
    public $number;

    /**
     * The fee 
     *
     * @var double
     */
    public $fee;

    /**
     * Response message from provider
     *
     * @var string
     */
    public $message;

    /**
     * Sending message form user to provider
     *
     * @var string
     */
    public $sendMessage;

    /**
     * Currency
     *
     * @var string
     */
    public $currency;

    /**
     * Provider name
     *
     * @var string
     */
    public $provider;

    /**
     * Remaining-balance
     *
     * @var string
     */
    public $balance;

    /**
     * Count
     *
     * @var string
     */
    public $count;

    /**
     * The code from each provider 
     *
     * @var string
     */
    public $code;

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

      

