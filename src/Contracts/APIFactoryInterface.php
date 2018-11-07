<?php 

namespace Maxin\Sms\Contracts;

use Maxin\Sms\Providers\AbstractAPI;

interface APIFactoryInterface 
{
    /**
     * simple factory pattern, that produce by the given string
     *
     * @return AbstractAPI
     */
    public function withAPI(string $api): AbstractAPI;
}