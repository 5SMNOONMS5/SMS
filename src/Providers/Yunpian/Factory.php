<?php

namespace Maxin\Sms\Providers\Yunpian;

use Maxin\Sms\Providers\Yunpian\AccountAPI;
use Maxin\Sms\Providers\Yunpian\MessageAPI;
use InvalidArgumentException;

class Factory
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function withAPI($name) {

        $instance = null;

        switch (strtolower($name)) {
            case "account":
                $instance = new AccountAPI($this->config);
                break;
            case "message":
                $instance = new MessageAPI($this->config);
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Unable to resolve given API for [%s].', $name
                ));
        }

        return $instance;
    }
}
