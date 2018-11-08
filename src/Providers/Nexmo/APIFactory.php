<?php

namespace Maxin\Sms\Providers\Nexmo;

use Maxin\Sms\Providers\Nexmo\BalanceAPI;
use Maxin\Sms\Providers\Nexmo\MessageAPI;
use Maxin\Sms\Providers\AbstractAPI;
use Maxin\Sms\Contracts\APIFactoryInterface;
use InvalidArgumentException;

class APIFactory implements APIFactoryInterface
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function withAPI(string $api): AbstractAPI
    {
        $instance = null;

        switch (strtolower($api)) {
            case "balance":
                $instance = new BalanceAPI($this->config);
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

