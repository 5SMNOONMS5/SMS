<?php

namespace Maxin\Sms\Providers;

use Maxin\Sms\Providers\AbstractProvider as AbstractProvider;

class Yunpian extends AbstractProvider
{	
	const ENDPOINT = [
		 'sms'      => 'sms/single_send.json',
		 'template' => 'sms/tpl_single_send.json',
		 'user'     => 'user/get.json'
	];

	public function setURLType(string $type)
    {
        $this->url = $this->getConfigValue('baseurl') . self::ENDPOINT[$type];   

        return $this;
    }

    // FIXME: $Description
	public function setParamters(array $scope = []) 
	{
		$this->queryParameters = array_merge($scope, [
			'apikey' => $this->getConfigValue('key')
		]);
		// dd($this->queryParameters, $this->url);
		return $this;
	}
}