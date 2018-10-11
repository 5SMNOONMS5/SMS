<?php

namespace Maxin\Sms\Providers\Yunpian;

use Maxin\Sms\Providers\Yunpian\AccountAPI;
use Maxin\Sms\Providers\Yunpian\MessageAPI;
use InvalidArgumentException;

class Factory
{
    public function withAPI($name) {

        $instance = null;

        switch (strtolower($name)) {
            case "account":
                $instance = new AccountAPI();
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
