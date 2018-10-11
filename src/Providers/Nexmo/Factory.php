<?php

namespace Maxin\Sms\Providers\Nexmo;

use Maxin\Sms\Providers\Nexmo\BalanceAPI;
use Maxin\Sms\Providers\Nexmo\MessageAPI;
use InvalidArgumentException;

class Factory
{
    public function withAPI($name) {

        $instance = null;

        switch (strtolower($name)) {
            case "balance":
                $instance = new BalanceAPI();
                break;
            case "message":
                $instance = new MessageAPI();
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Unable to resolve given API for [%s].', $name
                ));
        }

        return $instance;
    }
}
