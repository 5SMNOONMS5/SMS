<?php

namespace Maxin\Sms;

class Account
{	
    public function __construct($provider = "")
    {
        $this->provider = $provider;
    }   

	/**
     * Provider name
     *
     * @var string
     */
    public $provider;

    /**
     * Nick Name
     *
     * @var string
     */
    public $nickName;

    /**
     * Email
     *
     * @var string
     */
    public $email;

    /**
     * Mobile number
     *
     * @var string
     */
    public $mobile;

    /**
     * Balance
     *
     * @var string
     */
    public $balance;

    /**
     * Autoload
     *
     * @var string
     */
    public $autoload;

    /**
     * Map attributes
     *
     * @var string
     */
    public function map(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}