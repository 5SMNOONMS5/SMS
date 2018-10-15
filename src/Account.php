<?php

namespace Tasb00429\Sms;

class Account
{	
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

    public function __construct($provider)
    {
        $this->setProvider($provider);
    }

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
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * @param string $nickName
     *
     * @return self
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     *
     * @return self
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

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
}