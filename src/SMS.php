<?php

namespace Maxin\Sms;

use Maxin\Sms\Factory\SMSProviderFactory;

class SMS
{	
    public function __construct($provider)
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
     * Response message
     *
     * @var string
     */
    public $message;

    /**
     * Error message
     *
     * @var string
     */
    public $errorMessage;

    /**
     * Which provider sent it
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
     * The destination number
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

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return self
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return double
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param double $fee
     *
     * @return self
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return self
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param string $balance
     *
     * @return self
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param string $count
     *
     * @return self
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     *
     * @return self
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}

      

