<?php

namespace Maxin\Sms\Providers;

use Maxin\Sms\Providers\AbstractProvider as AbstractProvider;

class Nexmo extends AbstractProvider
{
    public function __construct()
    {
        $this->url = $this->getConfigValue('url');
    }

    // FIXME: $Description
    public function setParamters(array $scope = []) 
    {   
        $this->queryParameters = array_merge($scope, [
            'api_key'    => $this->getConfigValue('key'),
            'api_secret' => $this->getConfigValue('secret'),
            'type'       => 'unicode'
        ]);
        return $this;
    }
}